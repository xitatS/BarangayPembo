<?php
session_start();

if (isset($_POST['signuphtml'])) {

    $first_name = $_POST['first_name'];
    $middle_initial = $_POST['middle_initial'];
    $last_name = $_POST['last_name'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    $_SESSION['first_name'] = $first_name;
    $_SESSION['middle_initial'] = $middle_initial;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['birthday'] = $birthday;
    $_SESSION['email'] = $email;
    $_SESSION['username'] = $username;

    $name = $last_name . ", " . $first_name . " " . $middle_initial;

    $conn = mysqli_connect("localhost", "username", "password", "database");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $stmt = $conn->prepare("INSERT INTO signup (first_name, last_name, middle_initial, birthday, email, username) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $first_name, $last_name, $middle_initial, $birthday, $email, $username);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
    <title>User Profile</title>
</head>
<body>
<form method="POST" action="">
    <div class="container">
        <div class="left-column">
            <h2>YOUR ACCOUNT</h2>
            <ul>
                <li><a href="mainhtml.php">Home</a></li>
                <li><a href="profilehtml.php">Edit Profile</a></li>
                <li><a href="password.php">Change Password</a></li>
                <li><a href="#" onclick="confirmLogout()">Logout</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2>User Profile</h2>
            <div class="profile-picture" id="profile-picture">
                <img src="<?php echo !empty($profile_picture) ? $profile_picture : 'images/default_profile.png'; ?>" alt="Profile Picture">
            </div>

                <label for="first_name">First Name:</label>
                <span><?php echo isset($_SESSION['first_name']) ? $_SESSION['first_name'] : ''; ?></span>

                <label for="middle_initial">Middle Initial:</label>
                <span><?php echo isset($_SESSION['middle_initial']) ? $_SESSION['middle_initial'] : ''; ?></span>

                <label for="last_name">Last Name:</label>
                <span><?php echo isset($_SESSION['last_name']) ? $_SESSION['last_name'] : ''; ?></span>

                <label for="birthday">Birthday:</label>
                <span><?php echo isset($_SESSION['birthday']) ? $_SESSION['birthday'] : ''; ?></span>

                <label for="email">Email:</label>
                <span><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></span>

        </div>
    </div>
</form>

<script>
    function confirmLogout() {
        if (confirm("Are you sure you want to logout?")) {
            window.location.href = "logout.php?confirmed=yes";
        }
    }
</script>

</body>
</html>
