<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Basketball Court Permit Application</title>
    <link rel="stylesheet" type="text/css" href="brgypermit.css">
    <link rel="stylesheet" href="reset.css">
</head>
<body>
    <nav>
        <ul>
            <div class="logo">
                <img src="images/pemboLogo.png" alt="Barangay Pembo Logo">
            </div>
            <li><a href="mainhtml.php">HOME</a></li>
            <li><a href="CourtLocationhtml.php">BASKETBALL COURT LOCATION</a></li>
            <li><a href="Serviceshtml.php">BARANGAY SERVICES</a></li>
            <div class="logo2">
                <img src="images/makatiLogo.png" alt="Barangay Pembo Logo">
            </div>
        </ul>
    </nav>
    
    <form action="process_permit.php" method="post" onsubmit="return confirmSubmit()">
        <h1>Pembo Basketball Court Permit Application</h1><br>
        
        <?php
        session_start();
        if (isset($_SESSION['error_message'])) {
            echo '<div style="color: red; font-weight: bold;">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        if (isset($_SESSION['success_message'])) {
            echo '<div style="color: green; font-weight: bold;">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }
        ?><br>

        <div class="container">
            <div class="container1">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>" required><br><br>

                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?php echo isset($address) ? $address : ''; ?>" required><br><br>

                <label for="contact">Contact Number</label>
                <input type="tel" id="contact" name="contact" value="<?php echo isset($contact) ? $contact : ''; ?>" required><br><br>

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required><br><br>
            </div>

            <div class="container2">
                <label for="date">Date Requested</label>
                <input type="date" id="date" name="date" value="<?php echo isset($dateRequested) ? $dateRequested : ''; ?>" required>
                <br><br>

                <label for="time">Time Requested</label>
                <select id="time" name="time" required>
                    <option value="6:00am - 8:00am">6:00am - 8:00am</option>
                    <option value="8:00am - 10:00am">8:00am - 10:00am</option>
                    <option value="10:00am - 12:00pm">10:00am - 12:00pm</option>
                    <option value="12:00pm - 2:00pm">12:00pm - 2:00pm</option>
                    <option value="2:00pm - 4:00pm">2:00pm - 4:00pm</option>
                    <option value="4:00pm - 6:00pm">4:00pm - 6:00pm</option>
                    <option value="6:00pm - 8:00pm">6:00pm - 8:00pm</option>
                </select><br><br>

                <label for="courtlocation">Permit For</label>
                <select id="courtlocation" name="courtlocation" required>
                    <option value="Cactus Pembo">To Use Basketball Court in Cactus Pembo</option>
                    <option value="Umbel Pembo">To Use Basketball Court in Umbel Pembo</option>
                    <option value="Brgy. Hall Pembo">To Use Basketball Court in Barangay Hall Pembo</option>
                </select><br><br>

                <label for="purpose">Purpose</label>
                <select id="purpose" name="purpose" required>
                    <option value="Liga">Basketball</option>                   
                    <option value="Birthday Event">Birthday Event</option> 
                    <option value="Christening Day">Christening Day</option>
                    <option value="Group Practice">Group Practice</option>                  
                    <option value="Liga">Liga Event</option>
                    <option value="Social">Social Gathering</option>
                </select>
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
</body>
</html>
