<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: /DAS/login');
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'project');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get user email from session
$user_email = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.7/src/notiflix.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Amita:wght@400;700&family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/DAS/CSS/homepage.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .container {
            max-width: 900px;
            padding: 20px;
        }

        .appointment-card {
            border-radius: 10px;
            transition: 0.3s;
            background: white;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .appointment-card:hover {
            transform: scale(1.02);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
        }

        .status-badge {
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .cancel-btn {
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .cancel-btn:hover {
            background-color: #c82333;
        }

        .reschedule-btn {
            background-color: #ffc107;
            border: none;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .reschedule-btn:hover {
            background-color: #e0a800;
        }

        .date-box,
        .time-box {
            width: 100px;
            height: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 2px solid #007bff;
            border-radius: 12px;
            cursor: pointer;
            font-weight: bold;
            color: #007bff;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        .date-box:hover,
        .time-box:hover,
        .date-box.selected,
        .time-box.selected {
            background-color: #007bff;
            color: white;
        }

        .date-box span,
        .time-box span {
            display: block;
            text-align: center;
        }

        .date-box .month,
        .date-box .day,
        .date-box .weekday {
            font-size: 14px;
        }

        .time-box {
            width: 140px;
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            .navbar span {
                font-size: 0.9rem;
            }

            .container {
                padding: 10px;
            }

            .appointment-card {
                padding: 15px;
            }

            .appointment-card h5 {
                font-size: 1.1rem;
            }

            .appointment-card p {
                font-size: 0.9rem;
            }

            .date-box,
            .time-box {
                width: 80px;
                height: 80px;
                font-size: 12px;
            }

            .time-box {
                width: 100px;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1rem;
            }

            .navbar span {
                font-size: 0.8rem;
            }

            .container {
                padding: 5px;
            }

            .appointment-card {
                padding: 10px;
            }

            .appointment-card h5 {
                font-size: 1rem;
            }

            .appointment-card p {
                font-size: 0.8rem;
            }

            .date-box,
            .time-box {
                width: 60px;
                height: 60px;
                font-size: 10px;
            }

            .time-box {
                width: 80px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand nav-brand" href="#">DAS</a>
            <span class="text-muted ms-3">သင့်ကျန်းမာရေးသည် ကျွန်ုပ်တို့တာဝန်ဖြစ်သည်</span>
            <ul class="navbar-nav ms-0">
                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {

                    $user_id = $_SESSION['user_id'];

                    // Fetch user profile image from database
                    $stmt = $conn->prepare('SELECT profile_image FROM users WHERE userID = ?');
                    $stmt->bind_param('i', $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $user = $result->fetch_assoc();
                    $stmt->close();

                    // Set profile image path (Use default image if none exists)
                    $profileImage = (!empty($user['profile_image'])) ? '/DAS/PHP/uploads/' . $user['profile_image'] : '/DAS/PHP/uploads/bx-user-circle.svg';
                ?>
                    <li class="nav-item">
                        <a href="/DAS/profile">
                            <img src="<?php echo htmlspecialchars($profileImage); ?>?t=<?php echo time(); ?>"
                                class="profile-icon rounded-circle" width="40" height="40" style="object-fit: cover;">
                        </a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a href="/DAS/login" class="btn btn-success ms-3">Sign In</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h2 class="mb-4 text-center">📅 My Appointments</h2>

        <?php
        $stmt = $conn->prepare('
            SELECT b.id, d.name AS doctor_name, d.doctor_id, h.name AS hospital_name, h.hospital_id,
                   b.appointment_date, b.appointment_start_time, b.appointment_end_time, 
                   b.patient_name, b.symptoms
            FROM booking b
            JOIN doctors d ON b.doctor_id = d.doctor_id
            JOIN hospitals h ON b.hospital_id = h.hospital_id
            WHERE b.useremail = ?
            ORDER BY b.appointment_date DESC;
        ');
        $stmt->bind_param('s', $user_email);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>

        <?php if ($result->num_rows > 0) : ?>
            <div class="row">
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <div class="col-md-6 mb-4">
                        <div class="card appointment-card p-3">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">👨‍⚕️ <?php echo htmlspecialchars($row['doctor_name']); ?></h5>
                                <span class="badge bg-primary status-badge">Upcoming</span>
                            </div>
                            <p class="mb-1"><strong>🏥 Hospital:</strong> <?php echo htmlspecialchars($row['hospital_name']); ?></p>
                            <p class="mb-1"><strong>📅 Date:</strong> <?php echo htmlspecialchars($row['appointment_date']); ?></p>
                            <p class="mb-1"><strong>🕒 Time:</strong>
                                <?php
                                $start_time = htmlspecialchars($row['appointment_start_time']);
                                $end_time = htmlspecialchars($row['appointment_end_time']);
                                echo $start_time . ' - ' . $end_time;
                                ?>
                            </p>
                            <p class="mb-1"><strong>🤒 Symptoms:</strong> <?php echo htmlspecialchars($row['symptoms']); ?></p>
                            <button class="cancel-btn" data-bs-toggle="modal" data-bs-target="#cancelModal" data-id="<?php echo $row['id']; ?>">
                                Cancel
                            </button>
                            <button class="reschedule-btn mt-2" data-bs-toggle="modal" data-bs-target="#rescheduleModal" data-id="<?php echo $row['id']; ?>" data-hospital="<?php echo htmlspecialchars($row['hospital_id']); ?>" data-doctor="<?php echo htmlspecialchars($row['doctor_id']); ?>">
                                Reschedule
                            </button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p class="text-center text-muted">No appointments found.</p>
        <?php endif; ?>
    </div>

    <!-- Cancel Confirmation Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cancel Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to cancel this appointment?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="confirmCancel">Cancel Appointment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reschedule Appointment Modal -->
    <div class="modal fade" id="rescheduleModal" tabindex="-1" aria-labelledby="rescheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reschedule Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <input type="hidden" id="reschedule_booking_id">
                    <input type="hidden" id="reschedule_hospital_id">
                    <input type="hidden" id="reschedule_doctor_id">

                    <!-- Available Dates Section -->
                    <h6 class="text-primary fw-bold">Select Available Date</h6>
                    <div id="date-container" class="d-flex flex-wrap justify-content-center gap-3 mb-3"></div>

                    <!-- Available Time Section -->
                    <h6 class="text-primary fw-bold">Available Time</h6>
                    <div id="time-container" class="d-flex justify-content-center"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="confirmReschedule" disabled>Reschedule</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notiflix"></script>
    <script>
        // JavaScript for handling cancel and reschedule functionality
        let bookingIdToCancel = null;
        let bookingIdToReschedule = null;
        let hospitalIdToReschedule = null;
        let doctorIdToReschedule = null;
        let selectedDate = null;
        let selectedTime = null;

        $(document).ready(function() {
            // Cancel Appointment
            $(".cancel-btn").click(function() {
                bookingIdToCancel = $(this).data("id");
            });

            $("#confirmCancel").click(function() {
                if (bookingIdToCancel) {
                    Notiflix.Loading.dots('Processing...');
                    $.ajax({
                        url: "/DAS/PHP/cancel_booking.php",
                        type: "POST",
                        data: {
                            booking_id: bookingIdToCancel
                        },
                        dataType: "json",
                        success: function(response) {
                            Notiflix.Loading.remove();
                            if (response.status === "success") {
                                Notiflix.Report.success('Success', response.message, 'OK', () => {
                                    location.reload();
                                });
                            } else {
                                Notiflix.Report.failure('Error', response.message, 'OK');
                            }
                        },
                        error: function() {
                            Notiflix.Loading.remove();
                            Notiflix.Report.failure('Error', 'An error occurred while canceling the appointment.', 'OK');
                        }
                    });
                }
            });

            // Reschedule Appointment
            $(".reschedule-btn").click(function() {
                bookingIdToReschedule = $(this).data("id");
                hospitalIdToReschedule = $(this).data("hospital");
                doctorIdToReschedule = $(this).data("doctor");

                $("#reschedule_booking_id").val(bookingIdToReschedule);
                $("#reschedule_hospital_id").val(hospitalIdToReschedule);
                $("#reschedule_doctor_id").val(doctorIdToReschedule);

                // Clear previous selections
                $("#date-container").empty();
                $("#time-container").empty();
                $("#confirmReschedule").prop("disabled", true);

                fetchAvailableDates(hospitalIdToReschedule, doctorIdToReschedule);
            });

            $("#confirmReschedule").click(function() {
                if (!selectedDate || !selectedTime) {
                    Notiflix.Notify.failure("Please select a date and time.");
                    return;
                }

                Notiflix.Loading.dots('Rescheduling...');

                $.ajax({
                    url: "/DAS/PHP/reschedule_booking.php",
                    type: "POST",
                    data: {
                        booking_id: bookingIdToReschedule,
                        new_date: selectedDate,
                        new_time: selectedTime
                    },
                    dataType: "json",
                    success: function(response) {
                        Notiflix.Loading.remove();
                        if (response.status === "success") {
                            Notiflix.Report.success('Success', response.message, 'OK', function() {
                                location.reload();
                            });
                        } else {
                            Notiflix.Report.failure('Error', response.message, 'OK');
                        }
                    },
                    error: function() {
                        Notiflix.Loading.remove();
                        Notiflix.Report.failure('Error', 'An error occurred while rescheduling.', 'OK');
                    }
                });
            });
        });

        function fetchAvailableDates(hospitalId, doctorId) {
            $.post("/DAS/PHP/fetch_available_dates.php", {
                hospital_id: hospitalId,
                doctor_id: doctorId
            }, function(response) {
                let dateContainer = $("#date-container");
                dateContainer.empty();

                if (!response || response.length === 0) {
                    dateContainer.append("<p class='text-muted'>No available dates</p>");
                    return;
                }

                response.forEach(dateString => {
                    let formattedDate = new Date(dateString);

                    if (isNaN(formattedDate.getTime())) {
                        console.error("Invalid date received:", dateString);
                        return;
                    }

                    let dateElement = $(`
                        <div class="date-box" data-date="${dateString}">
                            <span class="month">${formattedDate.toLocaleString('en-US', { month: 'short' })}</span>
                            <span class="day">${formattedDate.getDate()}</span>
                            <span class="weekday">${formattedDate.toLocaleString('en-US', { weekday: 'short' })}</span>
                        </div>
                    `);

                    dateElement.click(function() {
                        $(".date-box").removeClass("selected");
                        $(this).addClass("selected");
                        selectedDate = $(this).data("date");

                        $("#time-container").empty();
                        selectedTime = null;
                        $("#confirmReschedule").prop("disabled", true);

                        fetchAvailableTimes(hospitalId, doctorId, selectedDate);
                    });

                    dateContainer.append(dateElement);
                });
            }, "json").fail(function(xhr, status, error) {
                console.error("AJAX error:", status, error);
            });
        }

        function fetchAvailableTimes(hospitalId, doctorId, date) {
            $.post("/DAS/PHP/fetch_available_times.php", {
                hospital_id: hospitalId,
                doctor_id: doctorId,
                date: date
            }, function(response) {
                let timeContainer = $("#time-container");
                timeContainer.empty();

                if (response.length === 0) {
                    timeContainer.append("<p class='text-muted'>No available times</p>");
                    return;
                }

                response.forEach(time => {
                    let timeElement = $(`
                        <div class="time-box" data-time="${time}">
                            <span>${time}</span>
                        </div>
                    `);

                    timeElement.click(function() {
                        $(".time-box").removeClass("selected");
                        $(this).addClass("selected");
                        selectedTime = $(this).data("time");

                        $("#confirmReschedule").prop("disabled", false);
                    });

                    timeContainer.append(timeElement);
                });
            }, "json");
        }
    </script>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>