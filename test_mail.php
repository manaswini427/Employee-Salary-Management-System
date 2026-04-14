<?php
include("send_mail.php");

$data = [
    "month" => "March",
    "year" => "2026",
    "net_salary" => "50000"
];

sendSalaryMail("yourprojecthr@gmail.com", "Test User", $data);
?>