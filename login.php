<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Barangay Pembo - Makati City</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


    <?php
    include 'inc/header1.php';
    Session::CheckLogin();
    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $recaptchaSecretKey = "6Lea9UApAAAAAJ2HyYQuSdv2nAMZcdNmzPmKJY9V"; 
        $recaptchaResponse = $_POST['g-recaptcha-response'];

        $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse";
        $recaptchaResult = json_decode(file_get_contents($recaptchaUrl));
        $userLog = $users->userLoginAuthotication($_POST);

    }

    if (isset($userLog)) {
      echo $userLog;
    }

    $logout = Session::get('logout');
    if (isset($logout)) {
      echo $logout;
    }
    ?>
    
</head>
<body>

<div class="card ">
  <div class="card-header">
          <h3 class='text-center1'><i class="fas fa-sign-in-alt mr-2"></i>Log-in</h3>
        </div>
        <div class="card-body">

            <div style="width:450px; margin:0px auto">

            <form class="" action="" method="post">
                <div class="form-group">
                  <input type="email" name="email"  class="form-control" placeholder="Email Address">
                </div>

                <div class="form-group">
                    <div class="password-input-container">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        <i class="fas fa-eye" id="togglePassword"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6Lea9UApAAAAAJ2HyYQuSdv2nAMZcdNmzPmKJY9V"></div>
                    <input type="hidden" name="recaptcha_response" id="recaptcha_response" required>
                </div>

                <div class="form-btn">
                  <button type="submit" name="login" onclick="return validateForm()" class="btn btn-success">Login</button>
                </div>

                </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const passwordInput = document.getElementById('password');
                const togglePasswordButton = document.getElementById('togglePassword');
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
            });

        function validateForm() {
            if (grecaptcha.getResponse().length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Prove that you are not a Robot.',
                });
                return false;
            }
        }
        </script>

</body>
</html>
