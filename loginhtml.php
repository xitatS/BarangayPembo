<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Login Page</title>
</head>

<body>
    <div class="container">
        <h1>USER LOGIN</h1>
        <form action="login.php" method="post">

            <?php
            session_start();
            if (isset($_SESSION['error'])) {
                echo '<div style="color: red; font-weight: bold;">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo '<div style="color: green; font-weight: bold;">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            ?>

            <p><label for="username">Username:</label></p>
            <input type="text" id="username" name="username" required>

            <div class="password-append">
                <p><label for="password">Password:</label></p>
                <input type="password" id="password" name="password" required>
                <i class="eye-icon" onclick="togglePassword('password')"><i id="password-eye-icon" class="far fa-eye"></i></i>
            </div>
            <br>
            <input type="submit" value="Login">
        </form>

        <div id="signup-link"><br>
            Don't have an account? <a href="signuphtml.php">Sign up</a>
        </div>
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
