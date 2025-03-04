<?php
// Database connection
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['email'])) {
    $useremail = $_SESSION['email'];
}

// Fetch unique job types
$jobTypeSql = "SELECT DISTINCT job_type FROM doctors";
$jobTypeResult = $conn->query($jobTypeSql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAS - ဆရာဝန်ရှာရန်</title>
    <link rel="stylesheet" href="/DAS/CSS/Find_Doctor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Amita:wght@400;700&family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.7/src/notiflix.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Your existing custom styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f9fc;
            color: #333;
        }

        .navbar {
            background: linear-gradient(90deg, #1a73e8, #155ea7);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-family: 'Amita', cursive;
            font-size: 1.8rem;
            font-weight: bold;
            color: #fff !important;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ffcc00 !important;
        }

        .navbar-toggler i {
            transition: transform 0.3s ease;
        }

        .rotate {
            transform: rotate(90deg);
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #fff;
            transition: transform 0.3s ease;
        }

        .profile-icon:hover {
            transform: scale(1.1);
        }

        .dropdown-menu {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .filters {
            flex: 1 1 250px;
            background-color: #fff;
            margin-top: 10px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .filters h2 {
            color: #1a73e8;
            margin-bottom: 20px;
        }

        .filters label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        .filters input[type="radio"] {
            margin-right: 10px;
        }

        .results {
            flex: 3 1 500px;
        }

        #search-box {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        .job-card {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .job-card h3 {
            color: #1a73e8;
            margin-bottom: 10px;
        }

        .job-card p {
            color: #555;
            margin-bottom: 10px;
        }

        .job-card .details {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .job-card .details span {
            font-weight: bold;
            color: #333;
        }

        .job-card .details button {
            background-color: #1a73e8;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .job-card .details button:hover {
            background-color: #155ea7;
        }

        #load-more {
            background-color: #1a73e8;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 20px auto;
        }

        #load-more:hover {
            background-color: #155ea7;
        }

        /* Back to Top Button Styling */
        #back-to-top {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            width: 50px;
            height: 50px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            transition: opacity 0.3s;
        }
        #back-to-top:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .filters {
                flex: 1 1 100%;
                margin-bottom: 20px;
            }

            .results {
                flex: 1 1 100%;
            }

            .search-bar {
                flex-direction: column;
            }

            .search-bar button {
                width: 100%;
            }

            .navbar-collapse {
                text-align: center;
            }

            .navbar-nav {
                align-items: center;
            }

            .navbar-nav .nav-item {
                width: 100%;
            }

            .navbar-nav .btn {
                width: 60%;
                margin-top: 10px;
            }

            .container .navbar-brand {
                width: 40px;
            }

            .container span {
                width: 200px;
                font-size: 0.8em;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">DAS</a>
            <span class="text-light">သင့်ကျန်းမာရေးသည် ကျွန်ုပ်တို့တာဝန်ဖြစ်သည်</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="/DAS/Home">ပင်မစာမျက်နှာ</a></li>
                    <li class="nav-item"><a class="nav-link" href="/DAS/doctor">ဆရာဝန်ရှာရန်</a></li>
                    <li class="nav-item"><a class="nav-link" href="/DAS/hospital">ဆေးရုံရှာရန်</a></li>
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
                        $conn = new mysqli('localhost', 'root', '', 'project');
                        if ($conn->connect_error) {
                            die('Connection failed: ' . $conn->connect_error);
                        }
                        $user_id = $_SESSION['user_id'];
                        $stmt = $conn->prepare('SELECT profile_image FROM users WHERE userID = ?');
                        $stmt->bind_param('i', $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $user = $result->fetch_assoc();
                        $stmt->close();
                        $profileImage = (!empty($user['profile_image'])) ? '/DAS/PHP/uploads/' . $user['profile_image'] : '/DAS/PHP/uploads/bx-user-circle.svg';
                    ?>
                        <li class="nav-item dropdown">
                            <a href="/DAS/profile">
                                <img src="<?php echo htmlspecialchars($profileImage); ?>?t=<?php echo time(); ?>" class="profile-icon" alt="Profile">
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a href="/DAS/login" class="btn btn-success">အကောင့်ဝင်ရန်</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Filters Section -->
        <aside class="filters" data-aos="fade-right" data-aos-duration="1000">
            <h2>အထူးပြုမှုများ</h2>
            <div>
                <label><input type="radio" name="specialty" value="All" checked> အားလုံး</label><br>
                <?php
                if ($jobTypeResult->num_rows > 0) {
                    while ($jobTypeRow = $jobTypeResult->fetch_assoc()) {
                        $jobType = htmlspecialchars($jobTypeRow['job_type']);
                        echo "<label><input type='radio' name='specialty' value='{$jobType}'> {$jobType}</label><br>";
                    }
                } else {
                    echo "<p>အထူးပြုမှုများ မရှိပါ။</p>";
                }
                ?>
            </div>
            <div>
                <h3>လိင်</h3>
                <label><input type="radio" name="gender" value="All" checked> အားလုံး</label><br>
                <label><input type="radio" name="gender" value="Male"> ကျား</label><br>
                <label><input type="radio" name="gender" value="Female"> မ</label><br>
            </div>
        </aside>

        <!-- Doctor Results Section -->
        <main class="results" data-aos="fade-left" data-aos-duration="1000">
            <input type="text" id="search-box" placeholder="ဆရာဝန်များကို ရှာရန်...">
            <h2>ဆရာဝန် - ရှာဖွေမှုရလဒ်များ</h2>
            <div id="doctor-list">
                <?php
                $sql = "SELECT * FROM doctors LIMIT 20";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $doctor_id = $row['doctor_id'];
                        echo "<div class='job-card' data-aos='fade-up' data-aos-duration='1000'>";
                        echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                        echo "<p>" . htmlspecialchars($row['credential']) . "</p>";
                        echo "<div class='details'>";
                        echo "<span>ဆွေးနွေးခ: " . number_format($row['consultation_fee']) . " ကျပ်</span>";
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                            echo '<form method="POST" action="/DAS/booking-doctor">';
                            echo '<input type="hidden" name="doctor_id" value="' . filter_var($row['doctor_id'], FILTER_VALIDATE_INT) . '">';
                            echo '<input type="hidden" name="email" value="' . $useremail . '">';
                            echo '<button type="submit">Book Now</button>';
                            echo '</form>';
                        } else {
                            echo '<button onclick="redirectToLogin()">Book Now</button>';
                        }
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>ဆရာဝန်များ မတွေ့ရှိပါ။</p>";
                }
                ?>
            </div>
            <button id="load-more" class="btn btn-primary" data-aos="fade-up" data-aos-duration="1000">ဆက်လက်ကြည့်ရှုရန်</button>
        </main>

        <!-- Back to Top Button -->
        <button id="back-to-top" title="Back to Top">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>

    <!-- AOS Initialization -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // Animation duration
            once: true, // Whether animation should happen only once
        });
    </script>

    <script>
        const toggler = document.querySelector('.navbar-toggler');
        const togglerIcon = toggler.querySelector('i');

        toggler.addEventListener('click', () => {
            togglerIcon.classList.toggle('rotate');
            togglerIcon.classList.toggle('fa-bars');
            togglerIcon.classList.toggle('fa-times');
        });

        function redirectToLogin() {
            Notiflix.Report.warning('သတိပေးချက်', 'ချိန်းဆိုမှုပြုလုပ်ရန် အကောင့်ဝင်ရန်လိုအပ်ပါသည်။', 'အိုကေ', () => {
                window.location.href = "/DAS/login";
            });
        }

        $(document).ready(function() {
            let offset = 20;

            // "See More" button for pagination
            $("#load-more").click(function() {
                $.ajax({
                    url: "/DAS/PHP/get_doctors.php",
                    type: "POST",
                    data: {
                        offset: offset
                    },
                    success: function(data) {
                        if ($.trim(data) !== "") {
                            $("#doctor-list").append(data);
                            offset += 20;
                        } else {
                            $("#load-more").hide();
                        }
                    }
                });
            });

            // Real-time Search
            $("#search-box").on("input", function() {
                const query = $(this).val().trim();
                if (query.length > 0) {
                    $.ajax({
                        url: "/DAS/PHP/search_doctors.php",
                        type: "POST",
                        data: {
                            search: query
                        },
                        success: function(data) {
                            $("#doctor-list").html(data);
                            $("#load-more").hide();
                        }
                    });
                } else {
                    $.ajax({
                        url: "/DAS/PHP/get_doctors.php",
                        type: "POST",
                        data: {
                            offset: 0
                        },
                        success: function(data) {
                            $("#doctor-list").html(data);
                            $("#load-more").show();
                            offset = 20;
                        }
                    });
                }
            });

            // Filter by Job Type and Gender
            $("input[name='specialty'], input[name='gender']").on("change", function() {
                const selectedJobType = $("input[name='specialty']:checked").val();
                const selectedGender = $("input[name='gender']:checked").val();

                $.ajax({
                    url: "/DAS/PHP/filter_doctors.php",
                    type: "POST",
                    data: {
                        job_type: selectedJobType,
                        gender: selectedGender
                    },
                    success: function(data) {
                        $("#doctor-list").html(data);
                        $("#load-more").hide();
                    }
                });
            });

            // Back to Top Button Functionality
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) { // Show button after scrolling 100px
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });

            $('#back-to-top').click(function() {
                $('html, body').animate({scrollTop: 0}, 500); // Smooth scroll to top
                return false;
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/notiflix"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>