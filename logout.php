<?php
session_start();

// Set the inactivity timeout to 5 minutes
$inactivityTimeout = 300; // 5 minutes in seconds

// Database connection details
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "barangaypembo";

// Create a database connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check for database connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Automatically create the login_logout_history table if it doesn't exist
$create_logout_history_table = "CREATE TABLE IF NOT EXISTS logout_history (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    USERNAME VARCHAR(255) NOT NULL,
    LOGOUT_TIME TIMESTAMP
)";
if ($conn->query($create_logout_history_table) === FALSE) {
    die("Error creating table: " . $conn->error);
}

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Check the last activity timestamp
    $lastActivity = isset($_SESSION['last_activity']) ? $_SESSION['last_activity'] : 0;

    // Check if the user has been inactive for the timeout period
    if (time() - $lastActivity > $inactivityTimeout) {
        // Log out the user and update logout history
        logoutAndRecordHistory();
    }

    // Update the last activity timestamp
    $_SESSION['last_activity'] = time();
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: loginhtml.php");
    exit();
}

// Function to log out the user and record logout history
function logoutAndRecordHistory() {
    global $conn; // Use the global connection variable

    if (isset($_SESSION['username'])) {
        $LOGOUT_TIME = time("g:i A");
        $username = $_SESSION['username'];

        // Update the logout time in the login_logout_history table
        $logout_time_sql = "UPDATE logout_history SET LOGOUT_TIME = ? WHERE USERNAME = ? AND LOGOUT_TIME IS NULL";
        $logout_time_stmt = $conn->prepare($logout_time_sql);
        $logout_time_stmt->bind_param("ss", $LOGOUT_TIME, $username);

        // Check for query errors
        if ($logout_time_stmt->execute() === FALSE) {
            die("Error updating logout time: " . $logout_time_stmt->error);
        }

        session_destroy();
    }

    header("Location: loginhtml.php");
    exit();
}
?>
