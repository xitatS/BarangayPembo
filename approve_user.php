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

if (isset($_GET['ID'])) {
    $lrn = $_GET['ID'];

    
    // Update the status to "Approved"
    $updateQuery = "UPDATE permit_bcourt SET STATUS = 'Approved' WHERE lrn = $lrn";

    if ($conn->query($updateQuery) === TRUE) {
        $_SESSION['success_message'] = "Permit approved successfully.";
    } else {
        $_SESSION['error_message'] = "Error approving permit: " . $conn->error;
    }

    // Redirect back to the page where the approval was initiated
    header("Location: admin_dashboard.php");
    exit();
} else {
    $_SESSION['error_message'] = "ID not provided.";
    header("Location: admin_dashboard.php");
    exit();
}

$conn->close();
?>