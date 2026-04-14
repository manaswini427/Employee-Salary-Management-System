<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

function sendPDFMail($to, $pdfPath){

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    // ✅ YOUR EMAIL HERE
    $mail->Username = 'yourprojecthr@gmail.com';

    // ✅ YOUR APP PASSWORD (NOT normal password)
    $mail->Password = 'yclqgtxnavafjaqa';

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('yourprojecthr@gmail.com', 'HR System');
    $mail->addAddress($to);

    // ✅ REQUIRED (YOU MISSED THIS BEFORE)
    $mail->isHTML(true);

    $mail->Subject = 'Salary Slip';
    $mail->Body    = 'Please find your salary slip attached.';

    // ✅ ATTACH PDF
    if(file_exists($pdfPath)){
        $mail->addAttachment($pdfPath);
    } else {
        die("PDF NOT FOUND FOR EMAIL");
    }

    $mail->send();

    return true;

} catch (Exception $e) {
    echo "MAIL ERROR: " . $mail->ErrorInfo;
}
}
?>