<?php
date_default_timezone_set('America/New_York'); // Set your desired timezone

require 'vendor/autoload.php';
require 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Generate a unique token
    $reset_token = bin2hex(random_bytes(50));
    $token_expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));

    // Update the user's reset token and expiry in the database
    $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
    $stmt->bind_param("sss", $reset_token, $token_expiry, $email);

    if ($stmt->execute()) {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0; // Change to 2 for detailed debugging
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'malshikainshari@gmail.com';
            $mail->Password = 'xeua wluw ejad qvvq';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('your.email@gmail.com', 'BeastBuddy');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $reset_link = "http://localhost/Web-Mini-Project/reset_password.php?token=$reset_token";
            $mail->Subject = 'Password Reset Request';
            $mail->Body = "Click the following link to reset your password: <a href='$reset_link'>Reset Password</a>";

            $mail->send();
            echo 'A password reset link has been sent to your email.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Failed to update reset token.";
    }
    $stmt->close();
}
$conn->close();
?>
