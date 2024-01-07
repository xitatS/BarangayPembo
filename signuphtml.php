<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="signup.css"> 
    <title>Registration</title>
</head>

<body>
    <div class="container">
        <h1>Register Account</h1>

        <?php
            session_start();
            if (isset($_SESSION['error'])) {
                echo '<div style="color: red; font-weight: bold;">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success_message'])) {
                echo '<div style="color: green; font-weight: bold;">' . $_SESSION['success_message'] . '</div>';
                unset($_SESSION['success_message']);
            }
        ?>

        <div class="left-container">
            <form class="form" method="post" action="signup.php">

                <p><label for="first_name">First Name:</label></p>
                <input type="text" id="first_name" name="first_name" required>

                <p><label for="middle_initial">Middle Initial:</label></p>
                <input type="text" id="middle_initial" name="middle_initial" required maxlength="2">

                <p><label for="last_name">Last Name:</label></p>
                <input type="text" id="last_name" name="last_name" required>

                <p><label for="birthday">Birthday:</label></p>
                <input type="date" id="birthday" name="birthday" required>
        </div>

        <div class="right-container">
            <p><label for="email">Email:</label></p>
            <input type="email" id="email" name="email" required>

            <p><label for="username">Username:</label></p>
            <input type="text" id="username" name="username" required>

            <div class="password-append">
                <p><label for="password">Password:</label></p>
                <input type="password" id="password" name="password" required>
                <i class="eye-icon" onclick="togglePassword('password')"><i id="password-eye-icon" class="far fa-eye"></i></i>
            </div>

            <div class="password-append">
                <p><label for="confirm password">Confirm Password:</label></p>
                <input type="password" id="confirm-password" name="confirm-password" required>
                <i class="eye-icon" onclick="togglePassword('confirm-password')"><i id="confirm-password-eye-icon" class="far fa-eye"></i></i>
            </div>
        </div>

        <div class="center-button">
            <button type="submit">Sign Up</button>
            <p class="login-link">Already have an account? <a href="loginhtml.php">Login</a></p>
        </div>

            </form>
    </div>

    <script>
        function togglePassword(inputId) {
            var x = document.getElementById(inputId);
            var icon = document.getElementById(inputId + "-eye-icon");

            if (x.type === "password") {
                x.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                x.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>

</body>
</html>
