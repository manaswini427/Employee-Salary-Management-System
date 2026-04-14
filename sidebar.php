<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>

<title>Salary Management System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
background:#f4f6f9;
font-family:Arial;
}

.sidebar{
position:fixed;
height:100%;
width:240px;
background:#1e293b;
color:white;
padding-top:20px;
}

.sidebar h3{
text-align:center;
margin-bottom:30px;
}

.sidebar a{
display:block;
color:white;
text-decoration:none;
padding:12px 20px;
margin:5px 10px;
border-radius:6px;
}

.sidebar a:hover{
background:#3b82f6;
}

.main{
margin-left:250px;
padding:25px;
}

.topbar{
background:white;
padding:15px;
border-radius:10px;
box-shadow:0px 3px 10px rgba(0,0,0,0.1);
margin-bottom:20px;
}

</style>

</head>

<body>

<div class="sidebar">

<h3>Admin Panel</h3>

<a href="dashboard.php"><i class="fa fa-chart-line"></i> Dashboard</a>

<a href="add_employee.php"><i class="fa fa-user-plus"></i> Add Employee</a>

<a href="manage_employee.php"><i class="fa fa-users"></i> Manage Employees</a>

<a href="add_attendance.php"><i class="fa fa-calendar-check"></i> Attendance</a>

<a href="auto_generate_salary_page.php"><i class="fa fa-money-bill"></i> Auto Generate Payroll</a>

<a href="view_salary.php"><i class="fa fa-file-invoice"></i> Salary Records</a>

<a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>

</div>

<div class="main">

<div class="topbar">
<h4>Salary Management System</h4>
</div>