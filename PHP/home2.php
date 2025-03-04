<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment System</title>
    <link rel="stylesheet" href="../CSS/Home_page.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.7/dist/notiflix-3.2.7.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../JS/jquery.js"></script>
    <style>
        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .profile-icon-container {
            display: flex;
            align-items: center;
            padding: 14px 16px;
        }

        .logout {
            display: flex;
            justify-content: flex-end;
            padding: 10px;
            margin-top: -100px;
            margin-left: 10px;
        }

        .logout button {
            padding: 10px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header>
        <nav>
            <div class="logo">DAS</div>
            <ul>
                <li><a href="Home_page.php">Home</a></li>
                <li><a href="Find_Doctor.php">Find Doctor</a></li>
                <li><a href="Find_Hospital.php">Find Hospital</a></li>
                <?php
                session_start();
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo '<li class="profile-icon-container"><a href="#"><img src="../Image/profile2.png" alt="Profile" class="profile-icon"></a></li>';
                } else {
                    echo '<li><a href="../Html/Sign_In.html">Sign In</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
    <!-- carousel -->
    <div class="carousel">
        <!-- list item -->
        <div class="list">
            <div class="item">
                <img src="../Image/wallpaperflare.com_wallpaper (5).jpg">
                <div class="content">
                    <div class="hospital">Hospital Name</div>
                    <div class="name">CITY</div>
                    <div class="topic">RATING</div>
                    <div class="des">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, none
                    </div>
                    <div class="buttons">
                        <button>SEE MORE</button>
                        <button>BOOK</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="../Image/wallpaperflare.com_wallpaper (4).jpg">
                <div class="content">
                    <div class="hospital">Hospital Name</div>
                    <div class="name">CITY</div>
                    <div class="topic">RATING</div>
                    <div class="des">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nobis, ullam.
                    </div>
                    <div class="buttons">
                        <button>SEE MORE</button>
                        <button>BOOK</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="../Image/wallpaperflare.com_wallpaper (3).jpg">
                <div class="content">
                    <div class="hospital">Hospital Name</div>
                    <div class="name">CITY</div>
                    <div class="topic">RATING</div>
                    <div class="des">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse, ipsa!
                    </div>
                    <div class="buttons">
                        <button>SEE MORE</button>
                        <button>BOOK</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="../Image/wallpaperflare.com_wallpaper (2).jpg">
                <div class="content">
                    <div class="hospital">Hospital Name</div>
                    <div class="name">CITY</div>
                    <div class="topic">RATING</div>
                    <div class="des">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore, placeat.
                    </div>
                    <div class="buttons">
                        <button>SEE MORE</button>
                        <button>BOOK</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- list thumnail -->
        <div class="thumbnail">
            <div class="item">
                <img src="../Image/wallpaperflare.com_wallpaper (5).jpg">
                <div class="content">
                    <div class="title">
                        Hospital Name
                    </div>
                    <div class="description">
                        CITY
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="../Image/wallpaperflare.com_wallpaper (4).jpg">
                <div class="content">
                    <div class="title">
                        Hospital Name
                    </div>
                    <div class="description">
                        CITY
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="../Image/wallpaperflare.com_wallpaper (3).jpg">
                <div class="content">
                    <div class="title">
                        Hospital Name
                    </div>
                    <div class="description">
                        CITY
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="../Image/wallpaperflare.com_wallpaper (2).jpg">
                <div class="content">
                    <div class="title">
                        Hospital Name
                    </div>
                    <div class="description">
                        CITY
                    </div>
                </div>
            </div>
        </div>
        <!-- next prev -->
        <div class="arrows">
            <button id="prev">
                << </button>
                    <button id="next">></button>
        </div>
        <!-- time running -->
        <div class="time"></div>
    </div>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo    '<div class="logout">
                    <form action="" id="logout">
                        <button type="submit">Log out</button>
                    </form>
                </div>';
    } else {
        echo '';
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.7/dist/notiflix-3.2.7.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#logout').submit(function(e) {
                e.preventDefault();
                Notiflix.Loading.standard('Logging out...');
                $.ajax({
                    type: 'POST',
                    url: '../PHP/logout.php',
                    success: function(response) {
                        if (response.status == 'success') {
                            Notiflix.Report.success('Success', response.message, 'OK', function() {
                                window.location.href = 'Home_Page.php';
                            });
                        } else {
                            Notiflix.Report.failure('Error', response.message, 'OK');
                        }
                    },
                    error: function(err) {
                        Notiflix.Report.failure('Error', 'An error occurred, please try again later.', 'OK');
                    }
                });
            });
        });
    </script>
    <script src="../JS/Home_Page.js"></script>

</body>

</html>