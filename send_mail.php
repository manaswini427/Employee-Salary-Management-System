<?php
// Include PHPMailer files
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// Import classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* FUNCTION TO SEND MAIL */
function sendMail($to, $link){

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // 🔴 YOUR EMAIL
        $mail->Username   = 'yourprojecthr@gmail.com';

        // 🔴 APP PASSWORD (keep your existing one)
        $mail->Password   = 'yclqgtxnavafjaqa';

        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender
        $mail->setFrom('yourprojecthr@gmail.com', 'Salary Management System');

        // Receiver (dynamic)
        $mail->addAddress($to);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Salary Slip Generated';

        $mail->Body = "
            <h3>Your Salary Slip is Ready</h3>
            <p>Click below to view/download:</p>
            <a href='$link' target='_blank'>View Salary Slip</a>
        ";

        // Send
        $mail->send();

    } catch (Exception $e) {
        echo "Mail Error: {$mail->ErrorInfo}";
    }
}
?>
