<?php
include("db.php");

$salary_id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT s.*, e.name 
    FROM salary s
    JOIN employees e ON s.employee_id = e.emp_id
    WHERE s.salary_id='$salary_id'
"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Salary Slip</title>
    <style>
        body { font-family: Arial; }
        .box {
            width: 600px;
            margin: auto;
            border: 1px solid #000;
            padding: 20px;
        }
        h2 { text-align: center; }
    </style>
</head>
<body>

<div class="box">
    <h2>Salary Slip</h2>
    <hr>

    <p><b>Name:</b> <?php echo $data['name']; ?></p>
    <p><b>Month:</b> <?php echo $data['month'] . " " . $data['year']; ?></p>
    <p><b>Basic:</b> ₹<?php echo $data['basic_salary']; ?></p>
    <p><b>Allowances:</b> ₹<?php echo $data['allowances']; ?></p>
    <p><b>Deductions:</b> ₹<?php echo $data['deductions']; ?></p>

    <hr>
    <h3>Net Salary: ₹<?php echo $data['net_salary']; ?></h3>

    <br><br>
    <button onclick="window.print()">Print / Save PDF</button>
</div>

</body>
</html>
