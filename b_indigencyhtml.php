<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Indigency</title>
    <link rel="stylesheet" type="text/css" href="brgypermit.css">
    <link rel="stylesheet" href="reset.css">
</head>
<body class="Indigency">
    <nav>
        <ul>
            <div class="logo">
                <img src="images/pemboLogo.png" alt="Barangay Pembo Logo">
            </div>
            <li><a href="mainhtml.php">HOME</a></li>
            <li><a href="HallLocation.php">BARANGAY HALL LOCATION</a></li>
            <li><a href="Serviceshtml.php">BARANGAY SERVICES</a></li>
            <div class="logo2">
                <img src="images/makatiLogo.png" alt="Barangay Pembo Logo">
            </div>
        </ul>
    </nav>
    
    <form action="b_indigency.php" method="post" onsubmit="return confirmSubmit()">
        <h1>Barangay Indigency</h1>
        <br>

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
                <input type="text" id="name" name="name" required><br><br>

                <label for="address">Address</label>
                <input type="text" id="address" name="address" required><br><br>

                <label for="contact">Contact Number</label>
                <input type="tel" id="contact" name="contact" required><br><br>

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required><br><br>
            </div>

            <div class="container2">

                <label for="birthday">Birthday</label>
                <input type="date" id="birthday" name="birthday" required><br><br>

                <label for="owner-name">Owner's Name</label>
                <input type="text" id="owner-name" name="owner-name" required><br><br>

                <label for="years">How Long Have You Resided At That Address?</label>
                <input type="text" id="years" name="years" required placeholder="How Many Years: Example: 3"><br><br>

                <label for="purpose">Your Purpose</label>
                <input type="text" id="purpose" name="purpose" required placeholder="Example: For Medical Assistance">
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
