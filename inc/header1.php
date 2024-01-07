<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath."/../lib/Session.php";
Session::init();

spl_autoload_register(function($classes){
  include 'classes/'.$classes.".php";
});

$users = new Users();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Barangay Pembo</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/style.css">
  </head>

  <script>
    function confirmLogout() {
      return confirm("Are you sure you want to logout?");
    }
  </script>
  
  <body>

    <div class="container2">
      <nav class="navbar navbar-expand-md navbar-dark bg-dark card-header">
        <span class="navbar-brand1"><i class="fas fa-home mr-2"></i>Barangay Pembo's  Services</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav ml-auto">

            <?php if (!Session::get('id')) { ?>

              <li class="nav-item <?php echo (basename($_SERVER['SCRIPT_FILENAME'], '.php') == 'register') ? 'active' : ''; ?>">
                <a class="nav-link" href="register.php"><i class="fas fa-user-plus mr-2"></i>Sign Up</a>
              </li>

              <li class="nav-item <?php echo (basename($_SERVER['SCRIPT_FILENAME'], '.php') == 'login') ? 'active' : ''; ?>">
                <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
              </li>

            <?php } else { ?>

              <li class="nav-item <?php echo (basename($_SERVER['SCRIPT_FILENAME'], '.php') == 'profile') ? 'active' : ''; ?>">
                <a class="nav-link" href="profile.php?id=<?php echo Session::get("id"); ?>"><i class="fab fa-500px mr-2"></i>Profile <span class="sr-only">(current)</span></a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="?action=logout" onclick="return confirmLogout();"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
              </li>

            <?php } ?>

          </ul>
        </div>
      </nav>
