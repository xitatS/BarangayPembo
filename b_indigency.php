<?php
session_start();

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "db_admin";

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$create_db_query = "CREATE DATABASE IF NOT EXISTS $db_name";
if ($conn->query($create_db_query) === FALSE) {
    die("Error creating database: " . $conn->error);
}

$conn->select_db($db_name);

$create_table_query = "CREATE TABLE IF NOT EXISTS indigency_applications (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(255) NOT NULL,
    BIRTHDAY DATE NOT NULL,
    CONTACT VARCHAR(10) NOT NULL,
    EMAIL VARCHAR(255) NOT NULL,
    ADDRESS VARCHAR(255) NOT NULL,
    OWNER_NAME VARCHAR(255) NOT NULL,
    YEARS VARCHAR(255) NOT NULL,
    PURPOSE VARCHAR(255) NOT NULL
)";

if ($conn->query($create_table_query) === FALSE) {
    die("Error creating table: " . $conn->error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $ownerName = $_POST['owner-name'];
    $years = $_POST['years'];
    $purpose = $_POST['purpose'];

    if (!is_numeric($contact) || strlen($contact) !== 11) {
        $_SESSION['error_message'] = "Invalid Contact Number! Please Enter a 11-Digit Numbers.";
        header("Location: b_indigencyhtml.php");
        exit();
    }

    if (!is_numeric($years)) {
        $_SESSION['error_message'] = "Invalid Input For Years! Please Enter a Numeric Value.";
        header("Location: b_indigencyhtml.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = "Invalid Email Address! Please Enter a Valid Email.";
        header("Location: b_indigencyhtml.php");
        exit();
    }

    $insert_query = "INSERT INTO indigency_applications (NAME, BIRTHDAY, CONTACT, EMAIL, ADDRESS, OWNER_NAME, YEARS, PURPOSE)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ssssssss", $name, $birthday, $contact, $email, $address, $ownerName, $years, $purpose);

    if ($stmt->execute() === FALSE) {
        error_log("Error executing statement: " . $stmt->error);
        $_SESSION['error_message'] = "An Error Occurred. Please Try Again Later.";
    } else {
        $_SESSION['success_message'] = "Application Submitted. Approval Pending. Kindly await Confirmation.";
    }

    $stmt->close();
}

$conn->close();

header("Location: b_indigencyhtml.php");
exit();
?>
