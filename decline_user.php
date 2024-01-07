<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_admin";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if student ID is provided in the request
if (isset($_GET['ID'])) {
    $lrn = $_GET['ID'];

    // Prepare and execute the SQL query to delete the student
    $updateQuery = "UPDATE permit_bcourt SET STATUS = 'Declined' WHERE lrn = $lrn";

    if ($conn->query($updateQuery) === TRUE) {
        $_SESSION['success_message'] = "Permit Declined Successfully.";
    } else {
        $_SESSION['error_message'] = "Error Declining Permit: " . $conn->error;
    }

    // Redirect back to the page where the deletion was initiated
    header("Location: admin_dashboard.php");
    exit();
} else {
    $_SESSION['error_message'] = " ID not provided.";
    header("Location: admin_dashboard.php");
    exit();
}

$conn->close();
?>