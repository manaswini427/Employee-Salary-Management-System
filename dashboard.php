<?php
include("db.php");

// Fetch data
$emp = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM employees"))['total'];
$salary = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(net_salary) as total FROM salary"))['total'];
$attendance = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(days_present) as total FROM attendance"))['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- INTERNAL CSS (NO FILE DEPENDENCY) -->
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            background: #1e293b;
            color: white;
            padding-top: 20px;
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #cbd5e1;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #334155;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .navbar {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card-box {
            padding: 20px;
            border-radius: 15px;
            color: white;
            margin-bottom: 20px;
        }

        .bg-blue { background: linear-gradient(45deg, #3b82f6, #2563eb); }
        .bg-green { background: linear-gradient(45deg, #10b981, #059669); }
        .bg-orange { background: linear-gradient(45deg, #f59e0b, #d97706); }
        .bg-red { background: linear-gradient(45deg, #ef4444, #dc2626); }

        .chart-box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3>HR Panel</h3>
    <a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
    <a href="add_employee.php"><i class="fa fa-user-plus"></i> Add Employee</a>
    <a href="manage_employee.php"><i class="fa fa-users"></i> Manage Employees</a>
    <a href="add_attendance.php"><i class="fa fa-calendar-check"></i> Attendance</a>
    <a href="generate_salary.php"><i class="fa fa-money-bill"></i> Generate Salary</a>
    <a href="view_salary.php"><i class="fa fa-file"></i> Salary Records</a>
    <a href="view_payscale.php"><i class="fa fa-table"></i> Payscale</a>
    <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
</div>

<!-- Content -->
<div class="content">

    <div class="navbar shadow-sm">
        <h4>Dashboard</h4>
    </div>

    <!-- Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="card-box bg-blue">
                <h5>Total Employees</h5>
                <h2><?php echo $emp; ?></h2>
                <i class="fa fa-users"></i>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-box bg-green">
                <h5>Total Salary Paid</h5>
                <h2>₹<?php echo $salary ?? 0; ?></h2>
                <i class="fa fa-money-bill"></i>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-box bg-orange">
                <h5>Total Attendance</h5>
                <h2><?php echo $attendance ?? 0; ?></h2>
                <i class="fa fa-calendar"></i>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-box bg-red">
                <h5>Leaves</h5>
                <h2>Auto</h2>
                <i class="fa fa-bed"></i>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row">
        <div class="col-md-6">
            <div class="chart-box">
                <h5>Monthly Salary Trend</h5>
                <canvas id="salaryChart"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="chart-box">
                <h5>Attendance Overview</h5>
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>
    </div>

</div>

<!-- Chart JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('salaryChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May'],
        datasets: [{
            label: 'Salary',
            data: [12000,19000,30000,50000,20000]
        }]
    }
});

new Chart(document.getElementById('attendanceChart'), {
    type: 'doughnut',
    data: {
        labels: ['Present','Absent'],
        datasets: [{
            data: [80,20]
        }]
    }
});
</script>

</body>
</html>