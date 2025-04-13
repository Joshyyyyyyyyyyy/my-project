<?php
session_start();
require "php/db.php";

if (!isset($_SESSION['email'])) {
    echo "Session expired or invalid access!";
    exit;
}

$success_message = $error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp1 = $_POST['otp1'];
    $otp2 = $_POST['otp2'];
    $otp3 = $_POST['otp3'];
    $otp4 = $_POST['otp4'];

    $entered_otp = $otp1 . $otp2 . $otp3 . $otp4;
    $email = $_SESSION['email'];

    $check_otp = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND otp = '$entered_otp'");

    if (mysqli_num_rows($check_otp) > 0) {
        mysqli_query($conn, "UPDATE users SET verification_status = 'verified' WHERE email = '$email'");
        $success_message = "✅ Account verified successfully! Redirecting to login...";
        header("refresh:3; url=login.php");
    } else {
        $error_message = "❌ Invalid OTP! Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/verify.css">
</head>
<body>
    <div class="form" style="text-align: center;">
        <h2>Verify Your Account</h2>
        <p>We emailed you the 4-digit OTP code. Enter it below to confirm your email address.</p>

        <?php if ($success_message): ?>
            <div class="success-text"><?= $success_message ?></div>
        <?php elseif ($error_message): ?>
            <div class="error-text"><?= $error_message ?></div>
        <?php endif; ?>

        <form method="POST" action="" autocomplete="off">
            <div class="fields-input">
                <input type="number" name="otp1" class="otp_field" placeholder="0" min="0" max="9" required>
                <input type="number" name="otp2" class="otp_field" placeholder="0" min="0" max="9" required>
                <input type="number" name="otp3" class="otp_field" placeholder="0" min="0" max="9" required>
                <input type="number" name="otp4" class="otp_field" placeholder="0" min="0" max="9" required>
            </div>
            <input type="submit" value="Verify Now" class="button">
        </form>
    </div>

    <script src="js/verify.js"></script>
</body>
</html>
