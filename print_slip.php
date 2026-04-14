<?php
include 'db.php';

if(!isset($_GET['id'])) {
    die("Invalid Access");
}

$id = $_GET['id'];

$query = "SELECT e.name, e.email, s.month, s.year, 
                 s.basic_salary, s.allowances, s.deductions, s.net_salary
          FROM salary s
          JOIN employees e ON s.employee_id = e.emp_id
          WHERE s.id = $id";

$result = mysqli_query($conn, $query);

if(!$result || mysqli_num_rows($result) == 0){
    die("Salary Record Not Found");
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Salary Slip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .slip-container {
            width: 700px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.2);
        }

        .company-header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .company-header h1 {
            margin: 0;
            color: #2c3e50;
        }

        .details {
            margin-bottom: 20px;
        }

        .details p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        .net-salary {
            margin-top: 20px;
            padding: 15px;
            background: #27ae60;
            color: white;
            font-size: 20px;
            text-align: center;
            border-radius: 5px;
        }

        .print-btn {
            margin-top: 20px;
            text-align: center;
        }

        .print-btn button {
            padding: 10px 20px;
            background: #2980b9;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print-btn button:hover {
            background: #1f6391;
        }

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="slip-container">

    <div class="company-header">
        <h1>ABC Company Pvt Ltd</h1>
        <p>Official Salary Slip</p>
    </div>

    <div class="details">
        <p><strong>Employee Name:</strong> <?php echo $row['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
        <p><strong>Month:</strong> <?php echo $row['month']; ?></p>
        <p><strong>Year:</strong> <?php echo $row['year']; ?></p>
    </div>

    <table>
        <tr>
            <th>Basic Salary</th>
            <th>Allowances</th>
            <th>Deductions</th>
        </tr>
        <tr>
            <td>₹ <?php echo $row['basic_salary']; ?></td>
            <td>₹ <?php echo $row['allowances']; ?></td>
            <td>₹ <?php echo $row['deductions']; ?></td>
        </tr>
    </table>

    <div class="net-salary">
        Net Salary: ₹ <?php echo $row['net_salary']; ?>
    </div>

    <div class="print-btn">
        <button onclick="window.print()">Print Salary Slip</button>
    </div>

</div>

</body>
</html>
