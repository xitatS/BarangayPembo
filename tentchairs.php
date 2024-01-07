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

$sqlCreateTable = "CREATE TABLE IF NOT EXISTS req_tentnchairs (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(255) NOT NULL,
    ADDRESS VARCHAR(255) NOT NULL,
    CONTACT VARCHAR(11) NOT NULL,
    EMAIL VARCHAR(255) NOT NULL,
    CURRENTDATE DATE NOT NULL,
    DATEREQUESTED DATE NOT NULL,
    REQUESTED_UNTIL DATE NOT NULL,
    TENTS_REQUESTED TEXT NOT NULL,
    CHAIRS_REQUESTED TEXT NOT NULL,
    PURPOSE TEXT NOT NULL,
    PERMIT_CODE VARCHAR(10) NOT NULL
)";

function generateRandomCode($length) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}

function redirectWithError($message) {
    $_SESSION['error_message'] = $message;
    header("Location: tentchairshtml.php");
    exit();
}

$conn->query($sqlCreateTable);

$dateRequested = new DateTime($_POST['date']);
$requestedUntil = new DateTime($_POST['enddate']);
$today = new DateTime();

if ($dateRequested <= $today) {
    redirectWithError("Sorry, the Selected Date is Already Over.");
}

if ($requestedUntil < $dateRequested) {
    redirectWithError("Sorry, the Requested Until Date Should be Later Than the Requested Date.");
}

if (!is_numeric($_POST['contact']) || strlen($_POST['contact']) !== 11) {
    redirectWithError("Invalid Contact Number! Please Enter a 11-Digit Numbers.");
}

$permitCode = generateRandomCode(8);
$sqlInsert = "INSERT INTO req_tentnchairs (NAME, ADDRESS, CONTACT, EMAIL, CURRENTDATE, DATEREQUESTED, REQUESTED_UNTIL, TENTS_REQUESTED, CHAIRS_REQUESTED, PURPOSE, PERMIT_CODE) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sqlInsert);

$name = $_POST['name'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$currentDate = date("Y-m-d");
$dateRequested = $_POST['date'];
$requestedUntil = $_POST['enddate'];
$tents = $_POST['tents'];
$chairs = $_POST['chairs'];
$purpose = $_POST['purpose'];

$stmt->bind_param("sssssssssss", $name, $address, $contact, $email, $currentDate, $dateRequested, $requestedUntil, $tents, $chairs, $purpose, $permitCode);

if ($stmt->execute()) {
    $_SESSION['success_message'] = "Application Submitted. Approval Pending. Kindly await Confirmation.";
    header("Location: tentchairshtml.php");
    exit();
} else {
    $_SESSION['error_message'] = "Error: " . $stmt->error . " - SQL: " . $stmt->sql . " - Message: " . $stmt->error;
    header("Location: tentchairshtml.php");
    exit();
}

$stmt->close();
$conn->close();