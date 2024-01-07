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

$sqlCreateTable = "CREATE TABLE IF NOT EXISTS permit_bcourt (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(255) NOT NULL,
    ADDRESS VARCHAR(255) NOT NULL,
    CONTACT VARCHAR(11) NOT NULL,
    EMAIL VARCHAR(255) NOT NULL,
    CURRENTDATE DATE NOT NULL,
    DATEREQUESTED DATE NOT NULL,
    TIMEREQUESTED VARCHAR(50) NOT NULL,
    COURTLOCATION VARCHAR(255) NOT NULL,   
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

$name = $_POST['name'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$currentDate = date("Y-m-d");
$dateRequested = $_POST['date'];
$timeRequested = $_POST['time'];
$courtlocation = $_POST['courtlocation'];
$purpose = $_POST['purpose'];

$permitCode = generateRandomCode(8);

$conn->query($sqlCreateTable);

function redirectWithError($message) {
    $_SESSION['error_message'] = $message;
    header("Location: tryhtml.php");
    exit();
}

if (!is_numeric($contact) || strlen($contact) !== 11) {
    redirectWithError("Invalid Contact Number! Please Enter a 11-Digit Numbers.");
} elseif ($courtlocation === "Umbel Pembo" && $timeRequested === "12:00pm - 2:00pm") {
    redirectWithError("Sorry, the Selected Time Slot (12:00pm - 2:00pm) is Not Available for Umbel Court. Please Choose Another Time Slot.");
} elseif ($courtlocation === "Umbel Pembo" && $timeRequested === "6:00pm - 8:00pm") {
    redirectWithError("Sorry, the Selected Time Slot (6:00pm - 8:00pm) is Not Available for Umbel Court. Please Choose Another Time Slot.");
} else {
    $currentDateTime = new DateTime();
    $selectedDate = new DateTime($dateRequested);

    if ($selectedDate < $currentDateTime) {
        redirectWithError("Sorry, the Chosen Date is Already Over.");
    } else {
        $sqlCheckAvailability = "SELECT COUNT(*) as count FROM permit_bcourt WHERE DATEREQUESTED = '$dateRequested' AND TIMEREQUESTED = '$timeRequested'";
        $result = $conn->query($sqlCheckAvailability);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($row['count'] > 0) {
                redirectWithError("Sorry, there is Already an Application for the Selected Date and Time. Please Choose Another Date or Time.");
            } else {
                $sqlInsert = "INSERT INTO permit_bcourt (NAME, ADDRESS, CONTACT, EMAIL, CURRENTDATE, DATEREQUESTED, TIMEREQUESTED, COURTLOCATION, PURPOSE, PERMIT_CODE) 
                    VALUES ('$name', '$address', '$contact', '$email', '$currentDate', '$dateRequested', '$timeRequested', '$courtlocation', '$purpose', '$permitCode')";

                if ($conn->query($sqlInsert) === TRUE) {
                    $_SESSION['success_message'] = "Application Submitted. Approval Pending. Kindly await Confirmation.";
                    header("Location: tryhtml.php");
                    exit();
                } else {
                    echo "Error: " . $sqlInsert . "<br>" . $conn->error;
                }
            }
        } else {
            echo "Error checking availability: " . $conn->error;
        }
    }
}

$conn->close();
?>
</body>
</html>
