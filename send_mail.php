<?php
// Include PHPMailer files (CORRECT PATH)
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// Import classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Create instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';        // SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'yourprojecthr@gmail.com';   // 🔴 Replace with your email
    $mail->Password = 'yclqgtxnavafjaqa';      // 🔴 Replace with app password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Sender & Receiver
    $mail->setFrom('yourprojecthr@gmail.com', 'Salary System');
    $mail->addAddress('yourprojecthr@gmail.com'); // 🔴 Replace

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Salary Generated';
    $mail->Body    = '<h3>Your salary has been generated successfully.</h3>';

    // Send email
    $mail->send();
    echo "Email sent successfully";

} catch (Exception $e) {
    echo "Message could not be sent. Error: {$mail->ErrorInfo}";
}
?>
