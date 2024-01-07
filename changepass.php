<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Barangay Pembo - Makati City</title>
    <link rel="stylesheet" type="text/css" href="main.css">

    <?php
    include 'inc/header.php';
    Session::CheckSession();
    ?>

    <?php
    if (isset($_GET['id'])) {
      $userid = (int)$_GET['id'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changepass'])) {
      $changePass = $users->changePasswordBysingelUserId($userid, $_POST);
    }

    if (isset( $changePass)) {
      echo  $changePass;
    }
    ?>

</head>
<body>

<div class="card ">
    <div class="card-header">
        <h3>Change your password <span class="float-right"> <a href="profile.php?id=<?php echo $userid; ?>" class="btn btn-primary">Back</a> </h3>
    </div>
    <div class="card-body">

        <div style="width:600px; margin:0px auto">

            <form class="" action="" method="POST">
                <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" name="old_password"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password"  class="form-control">
                </div>

                <div class="form-group text-center">
                    <button type="submit" name="changepass" class="btn btn-success">Change password</button>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>
