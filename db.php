<?php
$conn = mysqli_connect("localhost", "root", "", "salary_management");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
