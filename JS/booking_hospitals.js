document.addEventListener('DOMContentLoaded', function () {
    // Get elements
    const dateBox = document.getElementById('date-box');
    const timeBox = document.getElementById('time-box');
    const doctorBoxes = document.querySelectorAll('.doctor-box .option-box');
    const messageBox = document.querySelector("#message-box");
    const bookingForm = document.getElementById("booking-form");

    // Get hospitalId from PHP output
    const hospitalId = document.getElementById("hospital_id").value;
    console.log("Hospital ID:", hospitalId);

    // Add event listeners to doctor selection boxes
    doctorBoxes.forEach(box => {
        box.addEventListener('click', function () {
            Notiflix.Loading.standard("Fetching available dates...");
            doctorBoxes.forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
            const doctorId = this.getAttribute('data-doctor-id');
            console.log("Selected Doctor ID:", doctorId);

            // Update hidden input for doctor ID
            document.getElementById('doctor_id').value = doctorId;

            // Fetch available dates for the selected doctor
            setTimeout(() => {
                Notiflix.Loading.remove();
                fetchDates(doctorId);
            }, 1000);
        });
    });

    // Fetch available dates for a doctor
    async function fetchDates(doctorId) {
        // Clear previous dates and times
        dateBox.innerHTML = '';
        timeBox.innerHTML = '';

        try {
            // Fetch booked dates and row count
            const [bookedDates, rowCount] = await Promise.all([
                fetchBookedDates(doctorId),
                getRowCount(hospitalId, doctorId),
            ]);

            console.log("Booked Dates:", bookedDates);
            console.log("Row Count:", rowCount);

            // Fetch available dates from the server
            const response = await fetch(`/DAS/PHP/fetch_dates.php?hospital_id=${hospitalId}&doctor_id=${doctorId}`);
            const data = await response.text();
            const jsonData = JSON.parse(data);

            if (!Array.isArray(jsonData) || jsonData.length === 0) {
                console.error('No available dates found');
                messageBox.innerHTML = "<p style='color:red;'>No available dates found for this doctor.</p>";
                return;
            }

            // Generate the next 7 available dates
            const nextSevenDays = generateAvailableDates(jsonData, bookedDates, rowCount);
            if (nextSevenDays.length === 0) {
                console.error('No valid available days found');
                messageBox.innerHTML = "<p style='color:red;'>No valid available days found.</p>";
                return;
            }

            // Render available dates
            renderDates(nextSevenDays, doctorId);
        } catch (error) {
            console.error('Error fetching dates:', error);
            messageBox.innerHTML = "<p style='color:red;'>Something went wrong. Please try again.</p>";
        }
    }

    // Generate available dates based on booked dates and row count
    function generateAvailableDates(availableData, bookedDates, rowCount) {
        const today = new Date();
        const uniqueDays = new Set();
        const nextSevenDays = [];

        for (let i = 0; i < 60; i++) {
            const tempDate = new Date();
            tempDate.setDate(today.getDate() + i);
            const dateStr = tempDate.toISOString().slice(0, 10);
            const weekday = tempDate.toLocaleString('default', { weekday: 'short' });

            if (
                availableData.includes(dateStr) ||
                availableData.some(d => d.toLowerCase() === weekday.toLowerCase())
            ) {
                if (
                    !uniqueDays.has(dateStr) &&
                    (!bookedDates.includes(dateStr) || rowCount < 5)
                ) {
                    uniqueDays.add(dateStr);
                    nextSevenDays.push({ date: dateStr, d: tempDate });
                }
            }
            if (nextSevenDays.length === 7) break;
        }

        return nextSevenDays;
    }

    // Render available dates in the UI
    function renderDates(dates, doctorId) {
        dates.forEach(({ date, d }) => {
            const dateElement = document.createElement('div');
            dateElement.classList.add('option-box');
            dateElement.setAttribute('data-date', date);

            dateElement.innerHTML = `
                <span class="month">${d.toLocaleString('default', { month: 'short' })}</span>
                <span class="day">${d.getDate()}</span>
                <span class="weekday">${d.toLocaleString('default', { weekday: 'short' })}</span>
            `;

            dateElement.addEventListener('click', function () {
                Notiflix.Loading.standard("Fetching available times...");
                dateBox.querySelectorAll('.option-box').forEach(b => b.classList.remove('selected'));
                this.classList.add('selected');
                setTimeout(() => {
                    Notiflix.Loading.remove();
                    fetchTimes(doctorId, date, d);
                }, 1000);
            });

            dateBox.appendChild(dateElement);
        });
    }

    // Fetch available times for a selected date
    async function fetchTimes(doctorId, date, d) {
        timeBox.innerHTML = '';

        try {
            const response = await fetch(
                `/DAS/PHP/fetch_times.php?hospital_id=${hospitalId}&date=${date}&doctor_id=${doctorId}&day=${d.toLocaleString('default', { weekday: 'short' })}`
            );
            const data = await response.json();

            data.forEach(time => {
                const timeElement = document.createElement('div');
                timeElement.classList.add('option-box');
                timeElement.innerHTML = `<span class="time">${time}</span>`;
                timeElement.addEventListener('click', function () {
                    timeBox.querySelectorAll('.option-box').forEach(b => b.classList.remove('selected'));
                    this.classList.add('selected');
                });
                timeBox.appendChild(timeElement);
            });
        } catch (error) {
            console.error('Error fetching times:', error);
            messageBox.innerHTML = "<p style='color:red;'>Failed to fetch available times.</p>";
        }
    }

    async function getToken(hospitalId, doctorId) {
        const response = await fetch(`/DAS/PHP/get_token_number.php?hospital_id=${hospitalId}&doctor_id=${doctorId}`);
        const data = await response.text();
        const jsonData = JSON.parse(data);
        return jsonData;
    }

    // Handle form submission
    bookingForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        Notiflix.Loading.standard("Booking appointment...");

        const doctorId = document.querySelector("#doctor_id").value;
        const selectedDate = document.querySelector(".date-box .option-box.selected")?.dataset.date;
        const selectedTimeElement = document.querySelector(".time-box .option-box.selected");
        const selectedTime = selectedTimeElement ? selectedTimeElement.innerText.trim() : null;

        let tokens = await getToken(hospitalId, doctorId);
        console.log(tokens);

        let booked_token = 1;

        for (let i = 1; i <= 5; i++) {
            if (!tokens.includes(i)) {
                booked_token = i;
                break;
            }
        }

        console.log("Booked Tokens: ", booked_token);

        if (!selectedDate || !selectedTime) {
            Notiflix.Loading.remove();
            messageBox.innerHTML = "<p style='color:red;'>Please select a valid date and time.</p>";
            return;
        }

        const formData = new FormData(bookingForm);
        formData.append("date", selectedDate);
        formData.append("time", selectedTime);
        formData.append("token_number", booked_token);

        try {
            const response = await fetch("/DAS/PHP/booking_appointment.php", {
                method: "POST",
                body: formData,
            });
            const data = await response.json();

            Notiflix.Loading.remove();
            if (data.error) {
                messageBox.innerHTML = `<p style='color:red;'>${data.error}</p>`;
            } else {
                messageBox.innerHTML = `<p style='color:green;'>${data.message}</p>`;
                bookingForm.reset();
                dateBox.innerHTML = '';
                timeBox.innerHTML = '';
            }
        } catch (error) {
            console.error('Error:', error);
            Notiflix.Loading.remove();
            messageBox.innerHTML = "<p style='color:red;'>Something went wrong. Please try again.</p>";
        }
    });

    // Helper functions
    async function fetchBookedDates(doctorId) {
        const response = await fetch(`/DAS/PHP/fetch_booked_dates.php?hospital_id=${hospitalId}&doctor_id=${doctorId}`);
        const data = await response.json();
        return data.available_dates || [];
    }

    async function getRowCount(hospitalId, doctorId) {
        const response = await fetch(`/DAS/PHP/count_booking_row.php?hospital_id=${hospitalId}&doctor_id=${doctorId}`);
        const data = await response.json();
        return parseInt(data.total) || 0;
    }
});