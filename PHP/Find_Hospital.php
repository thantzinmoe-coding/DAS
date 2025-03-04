<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ဆေးရုံရှာရန်</title>
    <link rel="stylesheet" href="/DAS/CSS/Find_Hospital.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Amita:wght@400;700&family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.7/src/notiflix.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> <!-- AOS CSS -->
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

        .navbar-toggler i {
            transition: transform 0.3s ease;
        }

        .rotate {
            transform: rotate(90deg);
        }

        .container {
            max-width: 1200px;
            gap: 20px;
        }

        h1 {
            color: #1a73e8;
            text-align: center;
            margin-bottom: 30px;
        }

        .search-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        .search-bar input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        .search-bar button {
            background-color: #1a73e8;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-bar button:hover {
            background-color: #155ea7;
        }

        #hospitalList {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .hospital-card {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hospital-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .hospital-card h4 {
            color: #1a73e8;
            margin-bottom: 10px;
        }

        .hospital-card p {
            color: #555;
            margin-bottom: 10px;
        }

        .hospital-card button {
            background-color: #1a73e8;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .hospital-card button:hover {
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
            <span class="text-light ms-3">သင့်ကျန်းမာရေးသည် ကျွန်ုပ်တို့တာဝန်ဖြစ်သည်</span>
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

    <form>
        <input type="hidden" name="useremail" id="useremail" value="<?php
                                                                    if (isset($_SESSION['email'])) {
                                                                        $useremail = $_SESSION['email'];
                                                                        echo htmlspecialchars($useremail);
                                                                    }
                                                                    ?>">
    </form>

    <!-- Main Content -->
    <div class="container">
        <h1 data-aos="fade-down" data-aos-duration="1000" class="mt-2">သင့်ကျန်းမာရေးဝန်ဆောင်မှုများကို ဤနေရာတွင်ရရှိနိုင်ပါပြီ</h1>
        <div class="search-bar" data-aos="fade-up" data-aos-duration="1000">
            <input type="text" id="searchHospital" class="form-control" placeholder="ဆေးရုံအမည်ဖြင့် ရှာရန်...">
            <input type="text" id="filterLocation" class="form-control" placeholder="မြို့ သို့မဟုတ် ဒေသထည့်ပါ">
            <button onclick="fetchHospitals()">ရှာရန်</button>
        </div>
        <div id="hospitalList" class="mt-4"></div>

        <!-- Back to Top Button -->
        <button id="back-to-top" title="Back to Top">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>

    <script>
        function fetchHospitals() {
            const search = document.getElementById('searchHospital').value;
            const location = document.getElementById('filterLocation').value;

            fetch(`/DAS/PHP/fetch_hospitals.php?search=${search}&location=${location}`)
                .then(response => response.json())
                .then(data => displayHospitals(data))
                .catch(error => console.error('Error fetching hospitals:', error));
        }

        function displayHospitals(hospitals) {
            const hospitalList = document.getElementById('hospitalList');
            hospitalList.innerHTML = '';

            if (hospitals.length === 0) {
                hospitalList.innerHTML = '<p>ဆေးရုံများ မတွေ့ရှိပါ။</p>';
                return;
            }

            const useremail = document.getElementById("useremail").value;
            console.log(useremail);

            hospitals.forEach(hospital => {
                const card = `
                <div class="hospital-card" data-aos="fade-up" data-aos-duration="1000">
                    <h4>${hospital.name}</h4>
                    <p><strong>တည်နေရာ:</strong> ${hospital.location}</p>
                    <p><strong>အထူးပြုမှု:</strong> ${hospital.specialty}</p>
                    <p><strong>ဆက်သွယ်ရန်:</strong> ${hospital.contact}</p>
                    <p><strong>အဆင့်သတ်မှတ်ချက်:</strong> ${hospital.rating} ⭐</p>
                    ${hospital.emergency_services == 1 ? '<p><strong>၂၄/၇ အရေးပေါ်ဝန်ဆောင်မှုရှိပါသည် 🚑</strong></p>' : '<p><strong>အရေးပေါ်ဝန်ဆောင်မှုမရှိပါ ❌🚑</strong></p>'}
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <form method="POST" action="/DAS/booking-hospital">
                        <input type="hidden" name="hospital_id" value="${hospital.hospital_id}">
                        <input type="hidden" name="email" value="${useremail}">
                        <button type="submit" class="btn btn-success">Book Now</button>
                    </form>
                    <?php else: ?>
                        <button type="submit" class="btn btn-warning" onclick="redirectToLogin()">Book Now</button>
                        </form>
                    <?php endif ?>
                </div>`;
                hospitalList.innerHTML += card;
            });
        }

        fetchHospitals();
    </script>

    <!-- AOS Initialization -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // Animation duration
            once: true, // Whether animation should happen only once
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

        // Back to Top Button Functionality
        window.addEventListener('scroll', function() {
            const backToTop = document.getElementById('back-to-top');
            if (window.scrollY > 100) { // Show button after scrolling 100px
                backToTop.style.display = 'block';
                backToTop.style.opacity = '1';
            } else {
                backToTop.style.opacity = '0';
                setTimeout(() => backToTop.style.display = 'none', 300); // Match transition duration
            }
        });

        document.getElementById('back-to-top').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth' // Smooth scroll to top
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/notiflix"></script>
</body>

</html>