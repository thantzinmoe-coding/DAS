document.addEventListener('DOMContentLoaded', function () {
    // Get elements
    const dateBox = document.getElementById('date-box');
    const timeBox = document.getElementById('time-box');
    const hospitalBoxes = document.querySelectorAll('.hospital-box .option-box');
    const messageBox = document.querySelector("#message-box");
    hospitalBoxes.forEach(box => {
        box.addEventListener('click', function () {
            Notiflix.Loading.standard("Getting available dates...");
            hospitalBoxes.forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
            const hospitalId = this.getAttribute('data-hospital-id');
            console.log(hospitalId);
            setTimeout(() => {
                Notiflix.Loading.remove();
                fetchDates(hospitalId);
            }, 1000);
            // Also update a hidden input if needed (see form below)
            document.getElementById('hospital_id').value = hospitalId;
        });
    });

    async function rowCount(hospital_id, doctor_id) {
        const response = await fetch(`/DAS/PHP/count_booking_row.php?hospital_id=${hospital_id}&doctor_id=${doctor_id}`);
        const data = await response.text();
        const jsonData = JSON.parse(data);
        return parseInt(jsonData.total);
    }

    // Get doctorId from PHP output.
    var doctorId = document.getElementById("doctor_id").value;
    console.log(doctorId);

    function getNextDateFromDay(dayStr) {
        const days = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
        const today = new Date();
        let targetIndex = days.indexOf(dayStr.toUpperCase());
        if (targetIndex === -1) return null;
        let diff = targetIndex - today.getDay();
        if (diff <= 0) diff += 7;
        const result = new Date(today);
        result.setDate(today.getDate() + diff);
        return result;
    }

    function fetchDates(hospitalId) {
        // Clear previous dates and times
        dateBox.innerHTML = '';
        timeBox.innerHTML = '';
        let check = "";
        let checkTemp = new Date();
        (async () => {
            check = await fetchBookedDates(hospitalId);
            console.log(check);

            let book_date = check.map(date => new Date(date));
            console.log(book_date);
            let bookDayStr = book_date.map(date => date.toISOString().slice(0, 10));
            console.log(bookDayStr);

            const row = await rowCount(hospitalId, doctorId);
            console.log(row);

            if (isValidDate(book_date)) {
                const response = await fetch(`/DAS/PHP/fetch_dates.php?hospital_id=${hospitalId}&doctor_id=${doctorId}`)
                    .catch(error => {
                        console.log('Fetch error: ', error);
                        return null;
                    });
                const data = await response.text();
                console.log(data);
                const jsonData = JSON.parse(data);
                console.log(jsonData);
                if (jsonData) {
                    if (!Array.isArray(jsonData) || jsonData.length === 0) {
                        console.error('No available dates found');
                        return;
                    }

                    let today = new Date();
                    let uniqueDays = new Set();
                    let nextSevenDays = [];

                    for (let i = 0; i < 60; i++) {
                        let tempDate = new Date();
                        tempDate.setDate(today.getDate() + i);
                        let dateStr = tempDate.toISOString().slice(0, 10);
                        let weekday = tempDate.toLocaleString('default', {
                            weekday: 'short'
                        });

                        if (jsonData.includes(dateStr) || jsonData.some(d => d.toLowerCase() === weekday.toLowerCase())) {
                            if (!uniqueDays.has(dateStr) && !bookDayStr.includes(dateStr) || row < 5) {
                                uniqueDays.add(dateStr);
                                nextSevenDays.push({
                                    date: dateStr,
                                    d: tempDate
                                });
                            }
                        }
                        if (nextSevenDays.length === 7) break;
                    }

                    if (nextSevenDays.length === 0) {
                        console.error('No valid available days found');
                        return;
                    }

                    nextSevenDays.forEach(({
                        date,
                        d
                    }) => {
                        const dateElement = document.createElement('div');
                        dateElement.classList.add('option-box');
                        dateElement.setAttribute('data-date', date);

                        dateElement.innerHTML = `
                    <span class="month">${d.toLocaleString('default', { month: 'short' })}</span>
                    <span class="day">${d.getDate()}</span>
                    <span class="weekday">${d.toLocaleString('default', { weekday: 'short' })}</span>
                `;

                        dateElement.addEventListener('click', function () {
                            Notiflix.Loading.standard("Getting available times...");
                            dateBox.querySelectorAll('.option-box').forEach(b => b.classList.remove('selected'));
                            this.classList.add('selected');
                            setTimeout(() => {
                                Notiflix.Loading.remove();
                                fetchTimes(hospitalId, date, d);
                            }, 1000);
                        });

                        dateBox.appendChild(dateElement);
                    });
                }
            } else {
                const response = await fetch(`/DAS/PHP/fetch_dates.php?hospital_id=${hospitalId}&doctor_id=${doctorId}`)
                    .catch(error => {
                        console.log('Fetch error: ', error);
                        return null;
                    });
                const data = await response.text();
                console.log(data);
                const jsonData = JSON.parse(data);
                if (jsonData) {
                    if (!Array.isArray(jsonData) || jsonData.length === 0) {
                        console.error('No available dates found');
                        return;
                    }

                    let today = new Date();
                    let uniqueDays = new Set();
                    let nextSevenDays = [];

                    for (let i = 0; i < 60; i++) {
                        let tempDate = new Date();
                        tempDate.setDate(today.getDate() + i);
                        let dateStr = tempDate.toISOString().slice(0, 10);
                        let weekday = tempDate.toLocaleString('default', {
                            weekday: 'short'
                        });

                        if (jsonData.includes(dateStr) || jsonData.some(d => d.toLowerCase() === weekday.toLowerCase())) {
                            if (!uniqueDays.has(dateStr)) {
                                uniqueDays.add(dateStr);
                                nextSevenDays.push({
                                    date: dateStr,
                                    d: tempDate
                                });
                            }
                        }
                        if (nextSevenDays.length === 7) break;
                    }

                    if (nextSevenDays.length === 0) {
                        console.error('No valid available days found');
                        return;
                    }

                    nextSevenDays.forEach(({
                        date,
                        d
                    }) => {
                        const dateElement = document.createElement('div');
                        dateElement.classList.add('option-box');
                        dateElement.setAttribute('data-date', date);

                        dateElement.innerHTML = `
                    <span class="month">${d.toLocaleString('default', { month: 'short' })}</span>
                    <span class="day">${d.getDate()}</span>
                    <span class="weekday">${d.toLocaleString('default', { weekday: 'short' })}</span>
                `;

                        dateElement.addEventListener('click', function () {
                            Notiflix.Loading.standard("Getting available times...");
                            dateBox.querySelectorAll('.option-box').forEach(b => b.classList.remove('selected'));
                            this.classList.add('selected');
                            setTimeout(() => {
                                Notiflix.Loading.remove();
                                fetchTimes(hospitalId, date, d);
                            }, 1000);

                        });

                        dateBox.appendChild(dateElement);
                    });
                }
            }

        })();
    }

    async function getToken(hospitalId, doctorId) {
        const response = await fetch(`/DAS/PHP/get_token_number.php?hospital_id=${hospitalId}&doctor_id=${doctorId}`);
        const data = await response.text();
        const jsonData = JSON.parse(data);
        return jsonData;
    }

    function fetchTimes(hospitalId, date, d) {
        // Clear previous times
        timeBox.innerHTML = '';
        fetch(`/DAS/PHP/fetch_times.php?hospital_id=${hospitalId}&date=${date}&doctor_id=${doctorId}&day=${d.toLocaleString('default', { weekday: 'short' })}`)
            .then(response => response.json())
            .then(data => {
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
            });
    }

    document.getElementById("booking-form").addEventListener("submit", async function (event) {
        event.preventDefault(); // Prevent page reload

        // Start loading indicator
        Notiflix.Loading.standard("Making appointment...");

        const doctorId = document.querySelector("#doctor_id").value;
        const useremail = document.querySelector("#useremail").value;
        const hospitalId = document.querySelector("#hospital_id").value;
        const selectedDate = document.querySelector(".date-box .option-box.selected")?.dataset.date;
        const selectedTimeElement = document.querySelector(".time-box .option-box.selected");
        const selectedTime = selectedTimeElement ? (selectedTimeElement.dataset.time || selectedTimeElement.innerText.trim()) : null;
        const patientName = document.querySelector("#patient_name").value;
        const symptoms = document.querySelector("#symptoms").value;

        console.log("Selected Date:", selectedDate);
        console.log("Selected Time:", selectedTime);

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
            messageBox.innerHTML = "<p style='color:red;'>Please select a valid date and time.</p>";
            Notiflix.Loading.remove(); // Remove loading indicator if no date/time is selected
            return;
        }

        // Prepare form data
        const formData = new FormData();
        formData.append("doctor_id", doctorId);
        formData.append("useremail", useremail);
        formData.append("hospital_id", hospitalId);
        formData.append("date", selectedDate);
        formData.append("time", selectedTime);
        formData.append("patient_name", patientName);
        formData.append("symptoms", symptoms);
        formData.append("token_number", booked_token);

        // Send AJAX request
        fetch("/DAS/PHP/booking_appointment.php", {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                const jsonData = JSON.parse(data);
                Notiflix.Loading.remove(); // Always remove the loading indicator after the response

                if (jsonData.error) {
                    messageBox.innerHTML = `<p style='color:red;'>${jsonData.error}</p>`;
                } else {
                    const timeElement = document.createElement('div');
                    document.getElementById("booking-form").reset();
                    dateBox.innerHTML = '';
                    timeBox.innerHTML = '';
                    messageBox.innerHTML = `<p style='color:green;'>${jsonData.message}</p>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Notiflix.Loading.remove(); // Remove loading if an error occurs
                messageBox.innerHTML = "<p style='color:red;'>Something went wrong. Please try again.</p>";
            });
    });

    async function fetchBookedDates(hospitalId) {
        try {
            const response = await fetch(`/DAS/PHP/fetch_booked_dates.php?hospital_id=${hospitalId}&doctor_id=${doctorId}`);
            const data = await response.text();
            console.log('Raw data:', data); // Log the raw response data
            const jsonData = JSON.parse(data); // Parse the JSON string
            if (jsonData && jsonData.available_dates) {
                console.log('Available Dates:', jsonData.available_dates); // Log the available dates
                return jsonData.available_dates;
            } else {
                console.log('available_dates not found or is empty');
            }
        } catch (error) {
            console.error('Error: ', error.message);
            messageBox.innerHTML = "<p style='color:red;'>Something went wrong. Please try again.</p>";
        }
    }

    function isValidDate(dateStr) {
        let dates = dateStr.map(date => new Date(date));
        console.log(dates);
        return dates.every(date => !isNaN(date.getTime()));
    }

    document.getElementById("btnCancel").addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById("booking-form").reset();
        dateBox.innerHTML = '';
        timeBox.innerHTML = '';
        messageBox.innerHTML = '';

        window.location.href = "/DAS/doctor";
    });
});