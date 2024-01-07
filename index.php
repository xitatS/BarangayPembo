
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Barangay Pembo - Makati City</title>
    <link rel="stylesheet" type="text/css" href="main.css">

    <?php
    include 'inc/header.php';
    Session::CheckSession();

    $logMsg = Session::get('logMsg');
    if (isset($logMsg)) {
        echo $logMsg;
    }

    $msg = Session::get('msg');
    if (isset($msg)) {
        echo $msg;
    }

    Session::set("msg", NULL);
    Session::set("logMsg", NULL);
    ?>

    <?php
    if (isset($_GET['remove'])) {
        $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
        $removeUser = $users->deleteUserById($remove);
    }

    if (isset($removeUser)) {
        echo $removeUser;
    }

    if (isset($_GET['deactive'])) {
        $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
        $deactiveId = $users->userDeactiveByAdmin($deactive);
    }

    if (isset($deactiveId)) {
        echo $deactiveId;
    }

    if (isset($_GET['active'])) {
        $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
        $activeId = $users->userActiveByAdmin($active);
    }

    if (isset($activeId)) {
        echo $activeId;
    }
    ?>
</head>

<body>
  <div class="card ">
    <div class="card-header">
      <h3 class='text-center1'>User list <span class="float-right">Welcome! <strong>
        <span class="badge badge-lg badge-secondary text-white">

        <?php
        $username = Session::get('username');
        if (isset($username)) {
          echo $username;
        }
        ?></span>
        </strong></span></h3>
        </div>

        <div class="card-body pr-2 pl-2">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
          <th class="text-center">SL</th>
          <th class="text-center">Name</th>
          <th class="text-center">Username</th>
          <th class="text-center">Email Address</th>
          <th class="text-center">Mobile</th>
          <th class="text-center">Status</th>
          <th class="text-center">Created</th>
          <th width='25%' class="text-center">Action</th>
        </tr>
        </thead>

        <tbody>

        <?php  
        $loggedInUserId = Session::get("id");
        $loggedInUserRole = Session::get("roleid"); 
        $allUser = $users->selectAllUserData();

        if ($allUser) {
          $i = 0;
            foreach ($allUser as $value) {
                $i++;

                // Check if the logged-in user is an admin, or the user matches the logged-in user
                if (($loggedInUserRole == '1' && $value->roleid != '4') || ($loggedInUserRole == '4')) {
                    // Admin can see all users except SuperAdmin, SuperAdmin can see all users
                    $showUser = true;
                } elseif ($loggedInUserRole == '2' && $value->roleid != '1' && $value->roleid != '4') {
                    // Editor can see all users except admin and superadmin
                    $showUser = true;
                } elseif ($loggedInUserRole == '3' && $loggedInUserId == $value->id) {
                    // User can see only their own profile
                    $showUser = true;
                } else {
                    $showUser = false;
                }
                if ($showUser) {
        ?>

        <tr class="text-center" <?php if ($loggedInUserId == $value->id) {
          echo "style='background:#d9edf7'";
        } ?>>
          <td><?php echo $i; ?></td>
          <td><?php echo $value->name; ?></td>
          <td><?php echo $value->username; ?> <br>
        <?php

        if ($value->roleid  == '1') {
          echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";

        } elseif ($value->roleid == '2') {
          echo "<span class='badge badge-lg badge-success text-white'>Editor</span>";

        } elseif ($value->roleid == '3') {
          echo "<span class='badge badge-lg badge-dark text-white'>User</span>";

        } elseif ($value->roleid == '4') {
          echo "<span class='badge badge-lg badge-warning text-white'>SuperAdmin</span>";
        }


        ?></td>

          <td><?php echo $value->email; ?></td>
          <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->mobile; ?></span></td>
          <td>

        <?php if ($value->isActive == '0') { ?>
          <span class="badge badge-lg badge-info text-white">Active</span>
        <?php } else { ?>
          <span class="badge badge-lg badge-danger text-white">Deactive</span>
        <?php } ?>

          </td>
          <td><span class="badge badge-lg badge-secondary text-white"><?php echo $users->formatDate($value->created_at);  ?></span></td>
          <td>

        <?php if ($loggedInUserRole == '1' || $loggedInUserRole == '4') { ?>

          <!-- Admin actions -->
          <a class="btn btn-success btn-sm" href="profile.php?id=<?php echo $value->id; ?>">View</a>
          <a onclick="return confirm('Are you sure To Delete?')" class="btn btn-danger btn-sm

        <?php if ($loggedInUserId == $value->id) {
          echo "disabled";
        } ?>" href="?remove=<?php echo $value->id; ?>">Remove</a>

        <?php if ($value->isActive == '0') {  ?>
          <a onclick="return confirm('Are you sure To Deactivate?')" class="btn btn-warning btn-sm

        <?php if ($loggedInUserId == $value->id) {
          echo "disabled";
        } ?>" href="?deactive=<?php echo $value->id; ?>">Deactivate</a>

        <?php } elseif ($value->isActive == '1') { ?>
          <a onclick="return confirm('Are you sure To Activate?')" class="btn btn-secondary btn-sm

        <?php if ($loggedInUserId == $value->id) {
          echo "disabled";
        } ?>" href="?active=<?php echo $value->id; ?>">Activate</a>
        <?php } ?>

        <?php } elseif ($loggedInUserId == $value->id && $loggedInUserRole == '2') { ?>
        <!-- Editor actions for own profile -->
          <a class="btn btn-info btn-sm" href="profile.php?id=<?php echo $value->id; ?>">Edit</a>

        <?php } elseif ($loggedInUserRole == '3') { ?>
        <!-- User actions for own profile -->
          <a class="btn btn-info btn-sm" href="profile.php?id=<?php echo $value->id; ?>">Edit</a>
          <a class="btn btn-primary btn-sm" href="Show_Status_Report.php">Request Status</a>

        <?php } else { ?>
        <!-- Default user view -->
          <a class="btn btn-success btn-sm

        <?php if ($value->roleid == '1') {
          echo "disabled";
        } ?>" href="profile.php?id=<?php echo $value->id; ?>">View</a>
        <?php } ?>

          </td>
        </tr>
        <?php if ($value->roleid == '4') { ?>
            <a class="btn btn-primary btn-sm" href="admin_dashboard.php">Admin Dashboard</a>
        <?php } ?>
        
        <?php }}} else { ?>

        <tr class="text-center">
          <td>No user available now!</td>
        </tr>

        <?php } ?>

        </tbody>
        </table>
    </div>
  </div>


  <?php
  include 'inc/footer.php';

  ?>