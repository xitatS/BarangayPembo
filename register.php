<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Barangay Pembo - Makati City</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <?php
    include 'inc/header1.php';
    Session::CheckLogin();

    $register = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
            $register = $users->userRegistration($_POST);
        }

        if (isset($register)) {
            echo $register;
      }
    ?>
    
</head>
<body>
    <div class="card ">
        <div class="card-header">
            <h3 class='text-center1'>Account Registration</h3>
        </div>
        <div class="card-body">

            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="post">
                    <div class="form-group pt-3">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" class="form-control">
                        <input type="hidden" name="roleid" value="3">
                    </div>

                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" name="mobile" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-input-container">
                            <input type="password" name="password" class="form-control" id="password">
                            <i class="fas fa-eye" id="togglePassword"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <div class="password-input-container">
                            <input type="password" name="confirm_password" class="form-control" id="confirmPassword">
                            <i class="fas fa-eye" id="toggleConfirmPassword"></i>
                        </div>
                    </div>

                    <div class="form-btn">
                        <button type="submit" name="register" class="btn btn-success">Register</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const togglePasswordButton = document.getElementById('togglePassword');
            const confirmPassInput = document.getElementById('confirmPassword');
            const toggleConfirmPasswordButton = document.getElementById('toggleConfirmPassword');
            let holdTimer;

            const togglePassword = function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                togglePasswordButton.classList.toggle('fa-eye-slash');
            };

            togglePasswordButton.addEventListener('mousedown', function (event) {
                    event.preventDefault(); 
                    holdTimer = setTimeout(togglePassword, 500); 
            });

            togglePasswordButton.addEventListener('click', function (event) {
                    event.preventDefault(); 
                    togglePassword();
            });

            const toggleConfirmPassword = function () {
                const confirmType = confirmPassInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPassInput.setAttribute('type', confirmType);

                toggleConfirmPasswordButton.classList.toggle('fa-eye-slash');
            };

            toggleConfirmPasswordButton.addEventListener('mousedown', function (event) {
                    event.preventDefault(); 
                    holdTimer = setTimeout(toggleConfirmPassword, 500); 
            });

            toggleConfirmPasswordButton.addEventListener('click', function (event) {
                    event.preventDefault(); 
                    toggleConfirmPassword();
            });               
          });
    </script>


