<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.7/src/notiflix.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ladda-bootstrap/0.9.4/ladda-themeless.min.css"
        integrity="sha512-O82mrFLGbN9lUKQvbguKzEWmMtn4jO6txC9byiL0cjPGz4MeREeBY9dQR0ymgy8LhRgUL8JG0HtAGKYzg8pkTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../JS/jquery.js"></script>

</head>

<body>
    <div class="heading">
        <h2 class="mb-5 mt-5 text-center text-primary">Let's create an account for better life</h2>
    </div>
    <form action="AccountCreate.php" class="container w-50" method="post">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Enter name:</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Enter Phone Number</label>
            <input type="text" class="form-control" name="phoneNo">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Enter Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirmPassword">
        </div>
        <div class="col-12 text-center mt-5">
            <button class="btn btn-secondary" type="submit" name="cancel">Cancel</button>
            <button class="btn btn-primary ms-5 ladda-button" type="submit" name="submit" id="submit" data-style="expand-right"><span class="ladda-label">Create</span></button>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ladda-bootstrap/0.9.4/spin.min.js"
        integrity="sha512-qByKQKO3eTwzJtP8Y395YbP45QyYZNpJfYu8jfFpWgFTK2xWIiOER7G+63EoXk475fBFzY6HIhbEUio6m72EaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ladda-bootstrap/0.9.4/ladda.min.js"
        integrity="sha512-OxowQ96EheBKRxTivGsizVvTK8bWt2xZlymiMZ9MArbmOmuxbv+2IlC46k4gZPhZH5eVQAm0F6lk9Yt6M4xu7A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php

    if (isset($_POST['submit'])) {
        // <!-- <script>
        //     $('#submit').click(function(e) {
        //         e.preventDefault();
        //         var l = Ladda.create(this);
        //         l.start();

        //         setTimeout(() => {
        //             l.stop();
        //         }, 3000);
        //     });
        // </script> -->
        $name = $_POST['name'];
        $phoneNo = $_POST['phoneNo'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        echo $name;

        if ($name == "" | $phoneNo == "" | $password == "" | $confirmPassword == "") {
        ?>
            <script>
                errorMessage('Please fills all fields!');

                function successMessage(message) {
                    Swal.fire({
                        title: "Success!",
                        text: message,
                        icon: "success"
                    });
                }

                function errorMessage(message) {
                    Swal.fire({
                        title: "Error!",
                        text: message,
                        icon: "error"
                    });
                }
            </script>
    <?php
        }
    }

    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>