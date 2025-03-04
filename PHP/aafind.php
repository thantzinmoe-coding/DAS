<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAS</title>
    <link rel="stylesheet" href="../CSS/Find_Doctor.css">
    <script src="../JS/jquery.js"></script>
</head>

<body>

    <header>
        <nav>
            <div class="logo">DAS</div>
            <ul>
                <li><a href="Home_page.php">Home</a></li>
                <li><a href="Find_Doctor.php">Find Doctor</a></li>
                <li><a href="Find_Hospital.php">Find Hospital</a></li>
                <li><a href="Sign_In.php">Sign In</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <!-- Filters Section -->
        <aside class="filters">
            <form method="POST" action="" id="filter-form">
                <h2>Specialties</h2>
                <div>
                    <h3>Job Type</h3>
                    <label><input type="radio" name="specialty" id="Cardiologist" value="Cardiologist">Cardiology</label>
                    <label><input type="radio" name="specialty" id="Neurologist" value="Neurologist">Neurology</label>
                    <label><input type="radio" name="specialty" id="Pediatrician" value="Pediatrician">Pediatrics</label>
                    <label><input type="radio" name="specialty" id="Dermatologist" value="Dermatologist">Dermatology</label>
                    <label><input type="radio" name="specialty" id="Orthopedic Surgeon" value="Orthopedics Surgeon">Orthopedics </label>
                    <label><input type="radio" name="specialty" id="Oncologist" value="Oncologist">Oncology</label>
                    <label><input type="radio" name="specialty" id="Psychiatrist" value="Psychiatrist">Psychiatry</label>
                    <label><input type="radio" name="specialty" id="Endocrinologist" value="Endocrinologist">Endocrinology</label>
                    <label><input type="radio" name="specialty" id="Gastroenterologist" value="Gastroenterologist">Gastroenterology</label>
                    <label><input type="radio" name="specialty" id="Ophthalmologist" value="Ophthalmologist">Ophthalmology</label>
                </div>
                <div>
                    <h3>Gender</h3>
                    <label><input type="radio" id="male" name="gender" value="Male">Male</label>
                    <label><input type="radio" id="female" name="gender" value="Female">Female</label>
                </div>
            </form>
        </aside>

        <script>
            $(document).ready(function() {
                $('input[type="radio"]').click(function() {
                    var formData = $('#filter-form').serialize();
                    $.ajax({
                        type: 'POST',
                        url: 'aafind.php',
                        data: formData,
                        success: function(response) {
                            $('.results').html($(response).find('.results').html());
                        }
                    });

                    var specialty = $('input[name="specialty"]:checked').val();
                    switch (specialty) {
                        case "Cardiologist":
                            $('#Cardiologist').prop('checked', true);
                            break;
                        case "Neurologist":
                            $('#Neurologist').prop('checked', true);
                            break;
                        case "Pediatrician":
                            $('#Pediatrician').prop('checked', true);
                            break;
                        case "Dermatologist":
                            $('#Dermatologist').prop('checked', true);
                            break;
                        case "Orthopedics Surgeon":
                            $('#Orthopedic\\ Surgeon').prop('checked', true); // Fixed ID issue
                            break;
                        case "Oncologist":
                            $('#Oncologist').prop('checked', true);
                            break;
                        case "Psychiatrist":
                            $('#Psychiatrist').prop('checked', true);
                            break;
                        case "Endocrinologist":
                            $('#Endocrinologist').prop('checked', true);
                            break;
                        case "Gastroenterologist":
                            $('#Gastroenterologist').prop('checked', true);
                            break;
                        case "Ophthalmologist":
                            $('#Ophthalmologist').prop('checked', true);
                            break;
                    }
                });
            });
        </script>

        <!-- Job Results Section -->
        <main class="results">
            <h2>Doctor - Search Results</h2>
            <div>
                <?php

                include 'config.php';

                $job_type = isset($_POST['specialty']) ? $_POST['specialty'] : '';
                $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

                $sql = "SELECT id,name, job_type, credential, gender FROM doctors where 1=1";
                if (!empty($job_type)) {
                    $sql .= " AND job_type = '$job_type'";
                }

                if (!empty($gender)) {
                    $sql .= " AND gender = '$gender'";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {


                        echo '<div class="job-card">';
                        echo '<h3>' . $row["name"] . '</h3>';
                        echo '<p>' . $row["job_type"] . '</p>';
                        echo '<div class="details">';
                        echo '<p>' . $row["credential"] . '</p>';
                        echo '<form action="test.php" method="GET">';
                        echo '<input type="hidden" name="doctor_id" value="' . $row["id"] . '">';
                        echo '<button type="submit">Book Now</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        if (isset($_POST['doctor_id'])) {
                            exit;
                        }
                    }
                } else {
                    echo "0 results";
                }


                $conn->close();

                ?>
            </div>
        </main>
    </div>

</body>

</html>