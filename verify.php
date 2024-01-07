<!-- verify.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h3 class='text-center1'>OTP Verification</h3>
        </div>
        <div class="card-body">
            <div style="width:600px; margin:0px auto">
                <form class="" action="process_verify.php" method="post">
                    <div class="form-group pt-3">
                        <label for="otp">Enter OTP</label>
                        <input type="text" name="otp" class="form-control">
                    </div>
                    <div class="form-btn">
                        <button type="submit" name="verify" class="btn btn-success">Verify OTP</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
