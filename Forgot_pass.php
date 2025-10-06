<?php
include('../conn/conn.php'); // DB connection
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['reset'])) {
    $email = $_POST['email'];

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE email = :email");
    $stmt->execute(['email' => $email]);

        // Send email with reset link
        $mail = new PHPMailer(true);

        try {
            $verification = rand(100000, 999999);
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // e.g. Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'johnarthurtuliao141@gmail.com';
            $mail->Password = 'vzby orde jtbs bunk'; // Use App Password if Gmail
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            

            // Recipients
            $mail->setFrom('johnarthurtuliao141@gmail.com', 'Your App');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);  
            $mail->Subject = 'Verification Code';
            $mail->Body    = 'Your verification code is: ' .  $verification; 
            

            $mail->send();
            header('Location: http://localhost/login/verify.php');
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    } else {
        echo "Email not found!";
    }

    if (isset($_POST['verification'])) {
    $code = $_POST['is_verified'];

    // Get user ID from session (safer than hidden input)
    if (!isset($_SESSION['user_verification_id'])) {
        die("Session expired. Please register again.");
    }
    $userID = $_SESSION['user_verification_id'];

    // Check if code matches
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE id = :id AND is_verified = :code");
    $stmt->execute([
        'id' => $userID,
        'code' => $code
    ]);

    if ($stmt->rowCount() > 0) {
        // Update user as verified
        $update = $conn->prepare("UPDATE tbl_user SET is_verified = 1, is_verified = NULL WHERE id = :id");
        $update->execute(['id' => $userID]);

        echo "<div style='color:green;'>✅ Your email has been verified. You can now log in!</div>";
        // Optionally redirect to login
        // header("Location: login.php");
    } else {
        echo "<div style='color:red;'>❌ Invalid verification code. Please try again.</div>";
    }
}
?>
