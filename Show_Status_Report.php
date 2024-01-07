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
    if (isset($_SESSION['email'])) {
      $email = $_SESSION['email'];
     $sql = "SELECT permit_bcourt.ID, permit_bcourt.NAME, permit_bcourt.CONTACT, permit_bcourt.EMAIL, permit_bcourt.ADDRESS, permit_bcourt.STATUS as PermitCourtStatus, indigency_applications.STATUS as IndigencyStatus, req_tentnchairs.STATUS as TentChairsStatus
            FROM permit_bcourt
            JOIN indigency_applications ON permit_bcourt.ID = indigency_applications.ID
            JOIN req_tentnchairs ON permit_bcourt.ID = req_tentnchairs.ID
            WHERE permit_bcourt.EMAIL = '$email'";
    } else {
      echo "Email not found in session.";
      
      exit();
    }  

$result = $conn->query($sql);

?>

<?php
// Define SITEURL constant
define('SITEURL', 'login.php');
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
            transform: translateY(40px);
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
        h2 {
            font-family: 'Josefin Sans', sans-serif;
            margin-left: 150px;
            transform: translateY(30px);
            color: white;
        }
            .status.approved {
            color: #008000;
        }

        .status.declined {
            color: #ff0000;
        }

        .status.cancelled {
             color: #ff0000;
        }


         body {
        background-image: url('images/pembowp3.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        }

        button {

            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;

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
  </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <h2>Request Status</h2> 
        <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Permit Court Status</th>
                <th>Indigency Status</th>
                <th>Tent & Chairs Status</th>
            </tr>
        <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['NAME'] . "</td>";
                echo "<td>" . $row['CONTACT'] . "</td>";
                echo "<td>" . $row['EMAIL'] . "</td>";
                echo "<td>" . $row['ADDRESS'] . "</td>";
                echo "<td class='status " . strtolower($row['PermitCourtStatus']) . "'>" . $row['PermitCourtStatus'];
                if ($row['PermitCourtStatus'] != 'Declined' && $row['PermitCourtStatus'] != 'Cancelled' && $row['PermitCourtStatus'] != 'Approved') {
                    echo " <button onclick='cancelRequest(\"permit_bcourt\", " . $row['ID'] . ")'>Cancel</button>";
                }
                echo "</td>";

                echo "<td class='status " . strtolower($row['IndigencyStatus']) . "'>" . $row['IndigencyStatus'];
                if ($row['IndigencyStatus'] != 'Declined' && $row['IndigencyStatus'] != 'Cancelled' && $row['IndigencyStatus'] != 'Approved') {
                    echo " <button onclick='cancelRequest(\"indigency_applications\", " . $row['ID'] . ")'>Cancel</button>";
                }
                echo "</td>";

                echo "<td class='status " . strtolower($row['TentChairsStatus']) . "'>" . $row['TentChairsStatus'];
                if ($row['TentChairsStatus'] != 'Declined' && $row['TentChairsStatus'] != 'Cancelled' && $row['TentChairsStatus'] != 'Approved') {
                    echo " <button onclick='cancelRequest(\"req_tentnchairs\", " . $row['ID'] . ")'>Cancel</button>";
                }
                echo "</td>";

                echo "</tr>";
            }
            ?>

</table>

<script>
function cancelRequest(table, id) {
    var confirmation = confirm("Are you sure you want to cancel this request?");
    if (confirmation) {
        // If the user confirms, send an AJAX request to update the status in the database
        fetch(`cancel_request.php?table=${table}&ID=${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                // Handle the response if needed
                console.log(data);
                alert(data);  // Add an alert to display the response
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('Error updating record. Please check the console for details.');
            });
    }
}
</script>
