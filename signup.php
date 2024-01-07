<?php
session_start();

$db_host = "localhost"; 
$db_user = "root"; 
$db_password = ""; 
$db_name = "barangaypembo"; 

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$create_table_sql = "CREATE TABLE IF NOT EXISTS signup (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(255) NOT NULL,
    BIRTHDAY DATE NOT NULL,
    EMAIL VARCHAR(255) NOT NULL,
    USERNAME VARCHAR(50) NOT NULL,
    PASSWORD VARCHAR(255) NOT NULL
)";

if ($conn->query($create_table_sql) === TRUE) {
    echo "Table 'signup' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $middle_initial = $_POST["middle_initial"];
    $last_name = $_POST["last_name"];
    $birthday = $_POST["birthday"];
    $email = $_POST["email"]; 
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm-password"];

    $name = $last_name . ", " . $first_name . " " . $middle_initial;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: signuphtml.php");
        exit();
    }

    $email_check_sql = "SELECT ID FROM signup WHERE EMAIL = ?";
    $email_check_stmt = $conn->prepare($email_check_sql);
    $email_check_stmt->bind_param("s", $email);

    $email_check_stmt->execute();
    $email_check_stmt->store_result();

    if ($email_check_stmt->num_rows > 0) {
        $email_check_stmt->close();
        $_SESSION['error'] = "Email is already in use.";
        header("Location: signuphtml.php");
        exit();
    }

    $email_check_stmt->close();

    $username_check_sql = "SELECT ID FROM signup WHERE USERNAME = ?";
    $username_check_stmt = $conn->prepare($username_check_sql);
    $username_check_stmt->bind_param("s", $username);

    $username_check_stmt->execute();
    $username_check_stmt->store_result();

    if ($username_check_stmt->num_rows > 0) {
        $username_check_stmt->close();
        $_SESSION['error'] = "Username is already in use.";
        header("Location: signuphtml.php");
        exit();
    }

    $username_check_stmt->close();

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Password and Confirm Password do not match.";
        header("Location: signuphtml.php");
        exit();
    }

    $insert_sql = "INSERT INTO signup (NAME, BIRTHDAY, EMAIL, USERNAME, PASSWORD) VALUES (?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("sssss", $name, $birthday, $email, $username, $password); 

    if ($insert_stmt->execute()) {
        $_SESSION['success_message'] = "Successfully Registered!";
        header("Location: signuphtml.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $insert_stmt->error;
        header("Location: signuphtml.php");
        exit();
    }

    $insert_stmt->close();
    $conn->close();
}
?>
