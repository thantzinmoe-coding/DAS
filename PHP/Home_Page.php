<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ဆေးခန်းချိန်းဆိုမှုစနစ်</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Amita:wght@400;700&family=Poppins:wght@300;400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.7/src/notiflix.min.css">
    <link rel="stylesheet" href="/DAS/CSS/homepage.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            font-family: 'Poppins', sans-serif;
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

        .container {
            max-width: 1200px;
            gap: 20px;
        }

        header {
            background: url('/DAS/image/header-bg.jpg') no-repeat center center/cover;
            padding: 100px 0;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        header h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        header p {
            font-size: 1.2rem;
        }

        .hospital-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hospital-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .features {
            background-color: #f8f9fa;
            padding: 60px 0;
        }

        .features h2 {
            color: #1a73e8;
            margin-bottom: 40px;
        }

        .features h5 {
            color: #333;
            margin-top: 20px;
        }

        .features p {
            color: #555;
        }

        .features i {
            font-size: 3rem;
            color: #1a73e8;
            transition: transform 0.3s ease;
        }

        .features i:hover {
            transform: scale(1.2);
        }

        .testimonial-carousel .carousel-item {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .testimonial-carousel .carousel-item p {
            color: #333;
            font-size: 1.1rem;
            font-style: italic;
        }

        footer {
            background: linear-gradient(90deg, #1a73e8, #155ea7);
            color: #fff;
            padding: 40px 0;
        }

        footer a {
            color: #ffcc00;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .social-icons a {
            color: #fff;
            font-size: 1.5rem;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #ffcc00;
        }

        .dropdown-menu {
            background-color: rgb(208, 211, 208);
            width: 100%;
        }

        .btn-emergency {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-emergency:hover {
            background-color: #c82333;
            border-color: #bd2130;
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
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .navbar-nav .nav-item {
                width: 80%;
            }

            .navbar-nav .btn {
                width: 60%;
                margin-top: 10px;
                left: -20px;
            }

            .navbar-toggler {
                margin-left: auto;
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
            <span class="text-light ms-3">သင့်ကျန်းမာရေးကိုကျွန်ုပ်တို့တာဝန်ယူပါရစေ။</span>
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
                        // Database Connection
                        $conn = new mysqli('localhost', 'root', '', 'project');

                        if ($conn->connect_error) {
                            die('Connection failed: ' . $conn->connect_error);
                        }

                        $user_id = $_SESSION['user_id'];

                        // Fetch user profile image from database
                        $stmt = $conn->prepare('SELECT profile_image FROM users WHERE userID = ?');
                        $stmt->bind_param('i', $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $user = $result->fetch_assoc();
                        $stmt->close();
                        $conn->close();

                        // Set profile image path (Use default image if none exists)
                        $profileImage = (!empty($user['profile_image'])) ? '/DAS/PHP/uploads/' . $user['profile_image'] : '/DAS/PHP/uploads/bx-user-circle.svg';
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown">
                                <img src="<?php echo htmlspecialchars($profileImage); ?>?t=<?php echo time(); ?>"
                                    class="profile-icon" alt="Profile">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/DAS/profile">ပရိုဖိုင်း</a></li>
                                <li><a class="dropdown-item" href="#" id="logout">ထွက်ရန်</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a href="/DAS/login" class="btn btn-primary">အကောင့်ဝင်ရန်</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="text-center py-5" data-aos="fade-down" data-aos-duration="1000">
        <h1>သင့်ကျန်းမာရေးဝန်ဆောင်မှုများကို ဤနေရာတွင်ရရှိနိုင်ပါပြီ</h1>
        <p>ဆေးရုံများရှာဖွေခြင်း၊ ဆရာဝန်များနှင့် ချိန်းဆိုမှုများ ပြုလုပ်ခြင်း၊ ကျန်းမာရေးစစ်ဆေးမှုများကို ရယူခြင်း
        </p>
    </header>

    <!-- Top Hospitals -->
    <section class="container my-5">
        <h2 class="text-center text-success mb-4" data-aos="fade-up" data-aos-duration="1000">ထိပ်တန်းဆေးရုံများ</h2>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-right" data-aos-duration="1000">
                <div class="card hospital-card">
                    <img src="/DAS/Image/hospital1.jpg" alt="ရန်ကုန်အထွေထွေရောဂါကုဆေးရုံ" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">ရန်ကုန်အထွေထွေရောဂါကုဆေးရုံ</h5>
                        <p class="text-muted">အထွေထွေရောဂါများကို အထူးပြုကုသပေးသည်။</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-duration="1000">
                <div class="card hospital-card">
                    <img src="/DAS/Image/hospital2.jpg" alt="စမ်းချောင်းဆေးရုံ" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">စမ်းချောင်းဆေးရုံ</h5>
                        <p class="text-muted">အားကစားဆေးပညာကို အထူးပြုကုသပေးသည်။</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-left" data-aos-duration="1000">
                <div class="card hospital-card">
                    <img src="/DAS/Image/hospital3.jpg" alt="မင်္ဂလာတောင်ညွန့်ဆေးရုံ" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">မင်္ဂလာတောင်ညွန့်ဆေးရုံ</h5>
                        <p class="text-muted small">ဓာတ်မတည့်မှုနှင့်ကိုယ်ခံအားပညာကိုအထူးပြုကုသပေးသည်။</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <h2 class="text-center text-success mb-4" data-aos="fade-up" data-aos-duration="1000">ကျွမ်းကျင်ဆရာဝန်များ</h2>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-right" data-aos-duration="1000">
                <div class="card hospital-card">
                    <img src="/DAS/Image/doctor2-37.jpg" alt="ဒေါက်တာ ကောင်းမြတ်ထက်" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">ဒေါက်တာ ကောင်းမြတ်ထက်</h5>
                        <span>MBBS, DCH</span>
                        <p class="text-muted">ကလေးနဲ့ပတ်သက်သော ရောဂါကု အတွေ့အကြုံရှိသော ဆရာဝန်</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-duration="1000">
                <div class="card hospital-card">
                    <img src="/DAS/Image/doctor2-40.jpg" alt="‌ဒေါက်တာ ရဲန္ဒထက်" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">‌ဒေါက်တာ ရဲန္ဒထက်</h5>
                        <span>MBBS, DCH</span>
                        <p class="text-muted">အရိုးနှင့် အကြောဆိုင်ရာကုသမှု အတွေ့အကြုံရှိသော ဆရာဝန်</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-left" data-aos-duration="1000">
                <div class="card hospital-card">
                    <img src="/DAS/Image/doctor2-41.jpg" alt="ဒေါက်တာ သီဟဇော်" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">ဒေါက်တာ သီဟဇော်</h5>
                        <span>MBBS, DCH</span>
                        <p class="text-muted small">ကလေးနဲ့ပတ်သက်သော ရောဂါကု အတွေ့အကြုံရှိသော ဆရာဝန်</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features">
        <div class="container">
            <h2 class="text-center mb-4" data-aos="fade-up" data-aos-duration="1000">DAS ကို ဘာကြောင့် ရွေးချယ်သင့်သလဲ။
            </h2>
            <div class="row text-center">
                <div class="col-md-4" data-aos="fade-right" data-aos-duration="1000">
                    <i class="fa fa-user-md"></i>
                    <h5 class="mt-3">ကျွမ်းကျင်ဆရာဝန်များ</h5>
                    <p>ရောဂါအခြေအနေနှင့်ဆက်လျဉ်း၍ ထိပ်တန်းဆရာဝန်များနှင့် ချိတ်ဆက်ပါ။</p>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-duration="1000">
                    <i class="fa fa-hospital"></i>
                    <h5 class="mt-3">ယုံကြည်စိတ်ချရသောဆေးရုံများ</h5>
                    <p>ခေတ်မီပစ္စည်းကိရိယာများနှင့် အကောင်းဆုံးဆေးစစ်မှုများ၊ဝန်ဆောင်မှုများကို ဤ ဆေးရုံတွင်ရရှိနိုင်ပြီ</p>
                </div>
                <div class="col-md-4" data-aos="fade-left" data-aos-duration="1000">
                    <i class="fa fa-calendar-check"></i>
                    <h5 class="mt-3">လွယ်ကူသောချိန်းဆိုမှုများ</h5>
                    <p>ဘိုကင်တင်ရန်အတွက် မိမိစိတ်တိုင်းကျရွေးချယ်လိုက်ပါ</p>
                </div>
            </div>
        </div>
    </section>
    <div class="container text-center my-5 p-4 bg-white rounded shadow" data-aos="fade-right" data-aos-duration="1000">
        <p class="mb-4">အရေးပေါ်ဝန်ဆောင်မှုများအတွက် အောက်ဖော်ပြပါခလုတ်ကိုနှိပ်၍ဆက်သွယ်နိုင်ပါသည်</p>
        <a href="/DAS/emergency_case" class="btn btn-emergency btn-lg text-white">အရေးပေါ်ဝန်ဆောင်မှုအတွက် Emergency Page သိုဆက်သွယ်ပါ</a>
    </div>
    <!-- Footer -->
    <footer class="text-center py-4" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
            <p>© ၂၀၂၅ DAS Healthcare. မူပိုင်ခွင့်များအားလုံးရှိသည်။</p>
            <p>
                လိပ်စာ - ၁၂၃ မင်းလမ်း၊ ရန်ကုန်<br>
                ဖုန်း - ၀၉-၁၂၃၄၅၆၇၈၉<br>
                အီးမေးလ် - <a href="mailto:info@healthcare.com">info@healthcare.com</a>
            </p>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" title="Back to Top">
        <i class="fas fa-arrow-up"></i>
    </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notiflix"></script>
    <script src="/DAS/JS/jquery.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // Duration of animation
            once: true, // Whether animation should happen only once - while scrolling down
        });

        const toggler = document.querySelector('.navbar-toggler');
        const togglerIcon = toggler.querySelector('i');

        toggler.addEventListener('click', () => {
            togglerIcon.classList.toggle('rotate');
            togglerIcon.classList.toggle('fa-bars');
            togglerIcon.classList.toggle('fa-times');
        });

        $(document).ready(function() {
            $('#logout').click(function(e) {
                e.preventDefault();
                Notiflix.Loading.standard('ထွက်နေသည်...');
                $.ajax({
                    type: 'POST',
                    url: '/DAS/PHP/logout.php',
                    success: function(response) {
                        if (response.status == 'success') {
                            Notiflix.Report.success('အောင်မြင်သည်', response.message, 'အိုကေ',
                                function() {
                                    window.location.href = '/DAS/Home';
                                });
                        } else {
                            Notiflix.Report.failure('အမှား', response.message, 'အိုကေ');
                        }
                    },
                    error: function(err) {
                        Notiflix.Report.failure('အမှား',
                            'အမှားတစ်ခုဖြစ်ပွားခဲ့သည်၊ ကျေးဇူးပြု၍ ထပ်ကြိုးစားပါ။',
                            'အိုကေ');
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
</body>

</html>