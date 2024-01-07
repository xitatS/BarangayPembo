<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barangay Basketball Court Permit Application</title>
    <link rel="stylesheet" type="text/css" href="brgypermit.css">
    <link rel="stylesheet" href="reset.css">
</head>
<body class=tentchairs>
    <nav>
        <ul>
            <div class="logo3">
                <img src="images/pemboLogo.png" alt="Barangay Pembo Logo">
            </div>
            <li><a href="mainhtml.php">HOME</a></li>
            <li><a href="Serviceshtml.php">BARANGAY SERVICES</a></li>
            <div class="logo4">
                <img src="images/makatiLogo.png" alt="Barangay Pembo Logo">
            </div>
        </ul>
    </nav>
    
    <form action="tentchairs.php" method="post" onsubmit="return confirmSubmit()">
        <h1>Request for Tent and Chairs</h1>
        <br>
        <div class="success-message">

            <?php
            if (isset($_SESSION['success_message'])) {
                echo $_SESSION['success_message'];
                unset($_SESSION['success_message']); 
            }
            ?>

        </div>
        <div class="error-message">
            
            <?php
            if (isset($_SESSION['error_message'])) {
                echo $_SESSION['error_message'];
                unset($_SESSION['error_message']); 
            }
            ?>
            
        </div><br>

        <div class="container">
            <div class="container1">
                <br><br><br>
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required><br><br>

                <label for="address">Address</label>
                <input type="text" id="address" name="address" required><br><br>

                <label for="contact">Contact Number</label>
                <input type="tel" id="contact" name="contact" required><br><br>

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required><br><br>
            </div>

            <div class="container2">
                <label for="date">Date Requested</label>
                <input type="date" id="date" name="date" required><br><br>

                <label for="enddate">Requested Until</label>
                <input type="date" id="enddate" name="enddate" required><br><br>

                <label for="tents">Number of Tent Requesting</label>
                <select id="tents" name="tents" required>
                    <option value="No Tent">No Tent</option>
                    <option value="One Tent">One Tent</option>
                    <option value="Two Tents">Two Tents</option>
                </select><br><br>

                <label for="chairs">Number of Chairs Requesting</label>
                <select id="chairs" name="chairs" required>
                    <option value="No Chairs">No Chairs</option>
                    <option value="Ten Chairs">Ten Chairs</option>
                    <option value="Fifteen Chairs">Fifteen Chairs</option>
                    <option value="Twenty Chairs">Twenty Chairs</option>
                </select><br><br>

                <label for="purpose">Purpose</label>
                <select id="purpose" name="purpose" required>
                    <option value="For Birthday">For Birthday</option>
                    <option value="For Christening Day">For Christening Day</option>
                    <option value="For Funeral">For Funeral</option>
                    <option value="For Other Events">For Other Events</option>
                </select><br><br>

                </div>
            </div>

                <input type="submit" value="Submit Application">
        </div>
    </form>

     <script>
            function confirmSubmit() {
                return confirm("Are you sure you want to submit? Please Capture your Information before Submitting");
            }
        </script>

</body2>
</html>
       