<?php
include 'db.php';

$month = $_POST['month'];
$year = $_POST['year'];

/* GET ALL EMPLOYEES */
$emp_query = mysqli_query($conn,"SELECT * FROM employees");

while($emp = mysqli_fetch_assoc($emp_query)){

$emp_id = $emp['emp_id'];
$grade = $emp['grade'];

/* GET PAYSCALE */
$pay_query = mysqli_query($conn,"SELECT * FROM payscale WHERE grade='$grade'");
$pay = mysqli_fetch_assoc($pay_query);

$basic_salary = $pay['basic_salary'];
$per_day_salary = $pay['per_day_salary'];
$overtime_rate = $pay['overtime_per_hour'];

/* GET ATTENDANCE */
$att_query = mysqli_query($conn,"
SELECT * FROM attendance 
WHERE employee_id='$emp_id' 
AND month='$month' 
AND year='$year'
");

$att = mysqli_fetch_assoc($att_query);

if(!$att) continue;

$days_present = $att['days_present'];
$total_days = $att['Total_working_days'];
$leaves = $att['leaves'];
$overtime = $att['overtime_hours'];

/* CALCULATE SALARY */

$salary_earned = $days_present * $per_day_salary;
$leave_deduction = $leaves * $per_day_salary;
$overtime_pay = $overtime * $overtime_rate;

$net_salary = $salary_earned - $leave_deduction + $overtime_pay;

/* INSERT INTO SALARY TABLE */

mysqli_query($conn,"
INSERT INTO salary(
employee_id, month, year,
basic_salary, allowances, deductions, net_salary
) VALUES (
'$emp_id','$month','$year',
'$basic_salary','$overtime_pay','$leave_deduction','$net_salary'
)
");

}

echo "<script>alert('Salary Generated Automatically!'); window.location='dashboard.php';</script>";
?>