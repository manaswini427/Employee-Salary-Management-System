
<?php
function renderLayout($title, $content) {
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #1e293b;
            color: white;
            padding-top: 20px;
            overflow-y: auto;
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
            font-size: 15px;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background: #334155;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .topbar {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card-box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .btn-custom {
            background: #2563eb;
            color: white;
            border-radius: 25px;
        }

        .btn-custom:hover {
            background: #1e40af;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h3>HR Panel</h3>

    <a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
    <a href="add_employee.php"><i class="fa fa-user-plus"></i> Add Employee</a>
    <a href="manage_employee.php"><i class="fa fa-users"></i> Manage Employees</a>
    <a href="add_attendance.php"><i class="fa fa-calendar"></i> Attendance</a>
    <a href="generate_salary.php"><i class="fa fa-money-bill"></i> Generate Salary</a>
    <a href="view_salary.php"><i class="fa fa-file"></i> Salary Records</a>
    <a href="view_payscale.php"><i class="fa fa-table"></i> Payscale</a>
    <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
</div>

<!-- CONTENT -->
<div class="content">
    <div class="topbar shadow-sm">
        <h4><?php echo $title; ?></h4>
    </div>

    <?php echo $content; ?>
</div>

<!-- JS -->
<script src="assets/js/app.js"></script>

</body>
</html>
<?php } ?>