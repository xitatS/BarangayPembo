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

$sql = "SELECT * FROM permit_bcourt";
$result = $conn->query($sql);

?>

<?php
// Define SITEURL constant
define('SITEURL', 'login.php');
?>

<?php 

if (isset($_GET['ID']) && isset($_GET['action'])) {
    $lrn = $_GET['ID'];
    $action = $_GET['action'];

    if ($action === 'approve') {
        // Example: Update the status to 'Approved'
        $updateSql = "UPDATE permit_bcourt SET STATUS = 'Approved' WHERE ID = $lrn";
        $conn->query($updateSql);
    } elseif ($action === 'delete') {
        // Example: Update the status to 'Declined'
        $updateSql = "UPDATE permit_bcourt SET STATUS = 'Declined' WHERE ID = $lrn";
        $conn->query($updateSql);
    }

    // Redirect back to the same page with the current page information
    header("Location: {$_SERVER['PHP_SELF']}?page=$current_page");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN DASHBOARD</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
   
    <link rel="stylesheet" href="assets/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap');

        *{
            font-family: 'Josefin Sans', sans-serif;

        }
        body{
            height: 100vh;
        }

        table {
            margin-bottom: 15px;
            width: 15rem;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: solid 2px #fff;
            color: black;
            background-color: white;
        }

        span {
            color: #fff;
            
        }
    
        th, td {
            border: solid 2px #000000;
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #808080;
            color: #fff;
        }

        tr:hover {
            background-color: #999da0;
        }

        .app-button,
        .del-button {
            padding: 10px 10px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .app-button {
            background-color: #008000;
            color: #fff;
            border: none;
        }

        .del-button {
            background-color: #ff0000;
            color: #fff;
            border: none;
        }

        .approved {
        color: #008000;
        }

        .declined {
        color: #ff0000;
        }

        .app-button:hover, .del-button:hover{
            background-color: #4fa2ed; 
            color: #fff;
            text-decoration: none;
        }
    
        .req_tent, .indigency{
            position: sticky;
           padding: 10px 10px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            background-color: #6D798C;
        }

        .req_tent {
            left: 63%;
            transform: translateY(-25px);
            text-decoration: none;
        }
        .req_tent:hover, .indigency:hover {
           background-color: #4fa2ed; 
            color: #fff;
            text-decoration: none;
        }
        span {
                color: #fff;
            }

        .indigency {
            left: 80%;
            transform: translateY(-25px);
            text-decoration: none;

        }
       
        
        h2 {
            font-family: 'Josefin Sans', sans-serif;
            margin-left: 150px;
            transform: translateY(30px);
            color: white;
        }

        body {
        background-image: url('images/pembowp3.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;

        }


    </style>
</head>
</body>

<body>
    <div class="container2">
      <nav class="navbar navbar-expand-md navbar-dark bg-dark card-header" style="width:100%">
        <span class="navbar-brand1"><i class="fas fa-home mr-2"></i>Barangay Pembo's  Services</span>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITEURL; ?>" onclick="return"><i class="fas fa-sign-out-alt mr-2"></i>User Lists</a>              
            </li>

          </ul>
        </div>
      </nav>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <h2>Basketball Court Permit</h2> 
            <button class="req_tent"> <a href="req_tent.php"><span>
            REQUEST TENT & CHAIRS</span>
        </a></button>
        <button class="indigency" ><a href="indigency.php"><span>
            INDIGENCY APPLICATIONS</span>

        </button></a>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Current Date</th>
                <th>Court Location</th>
                <th>Purpose</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['NAME'] . "</td>";
                echo "<td>" . $row['ADDRESS'] . "</td>";
                echo "<td>" . $row['CONTACT'] . "</td>";
                echo "<td>" . $row['EMAIL'] . "</td>";
                echo "<td>" . $row['CURRENTDATE'] . "</td>";
                echo "<td>" . $row['COURTLOCATION'] . "</td>";
                echo "<td>" . $row['PURPOSE'] . "</td>";
                echo "<td class='" . strtolower($row['STATUS']) . "'>" . $row['STATUS'] . "</td>";            
                echo "<td>
                    <a class='app-button' href='javascript:void(0);' onclick='confirmAction(\"approve\", " . $row['ID'] . ")'><span>Approve</span></a> |
                    <a class='del-button' href='javascript:void(0);' onclick='confirmAction(\"delete\", " . $row['ID'] . ")'><span>Decline</span></a>
                </td>";
                echo "</tr>";
            }
            ?>

    </table>

    

    <script>
        function confirmAction(action, id) {
            var confirmationMessage = '';
            
            if (action === 'approve') {
                confirmationMessage = 'Are you sure you want to approve?';
            } else if (action === 'delete') {
                confirmationMessage = 'Are you sure you want to decline?';
            }

            if (confirm(confirmationMessage)) {
                window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>?ID=' + id + '&action=' + action;
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
// Close the database connection after using it
$conn->close();
?>
