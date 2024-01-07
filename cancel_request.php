<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_admin";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$table = $_GET['table'];
$id = $_GET['ID'];

// Assuming you have a 'STATUS' column in each table
$sql = "UPDATE $table SET STATUS = 'Cancelled' WHERE ID = $id";

if ($conn->query($sql) === TRUE) {
    echo "Request cancelled successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>