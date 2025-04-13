<?php
session_start();
require "db.php";
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/SMTP.php';
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname   = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname   = mysqli_real_escape_string($conn, $_POST['lname']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $phone   = mysqli_real_escape_string($conn, $_POST['phone']);
    $pass    = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $cpass   = $_POST['cpass'];
    $role    = "User";
    $otp     = rand(1000, 9999);
    $unique_id = uniqid();

    // Check if email already exists
    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check_email) > 0) {
        echo "This email is already registered!";
        exit;
    }

    // Handle image upload
    $image_name = $_FILES['image']['name'];
    $tmp_name   = $_FILES['image']['tmp_name'];
    $upload_dir = __DIR__ . '/../image/';
    $image_path = $upload_dir . $image_name;

    if (move_uploaded_file($tmp_name, $image_path)) {
        // Save to database
        $insert = mysqli_query($conn, "INSERT INTO users 
        (unique_id, fname, lname, email, phone, image, password, otp, verification_status, Role)
        VALUES ('$unique_id', '$fname', '$lname', '$email', '$phone', '$image_name', '$pass', '$otp', 'not verified', '$role')");

        if ($insert) {
            $_SESSION['email'] = $email;

            // Send OTP via PHPMailer
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'suruiz.joshuabcp@gmail.com';
                $mail->Password   = 'jftrtlkbspjyjnng'; // App Password
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom('suruiz.joshuabcp@gmail.com', 'Admin');
                $mail->addAddress($email, $fname);

                $mail->isHTML(true);
                $mail->Subject = 'Your OTP Verification Code';
                $mail->Body    = "<h3>Your OTP Code is: <b>$otp</b></h3>";

                $mail->send();

                // ✅ Redirect to verification page after email sent
                header("Location: verify.php");
                exit;

            } catch (Exception $e) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }

        } else {
            echo "Something went wrong while saving your data.";
        }
    } else {
        echo "Image upload failed!";
    }
} else {
    echo "Invalid request!";
}
?>
