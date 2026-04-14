<?php
$host = "autorack.proxy.rlwy.net";
$user = "root";
$password = "tqxVIcWYgbkqzOXPTzJGdWAnkpSEdTWT";
$db = "railway";
$port = 44088;

$conn = mysqli_connect($host, $user, $password, $db, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
