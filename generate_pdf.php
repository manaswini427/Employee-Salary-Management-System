<?php
include("db.php");
include("layout.php");
include_once("send_mail.php");

require __DIR__ . '/dompdf/vendor/autoload.php';
use Dompdf\Dompdf;

$msg = "";

if(isset($_POST['generate'])){

    $emp_id = $_POST['employee_id'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    /* CHECK DUPLICATE */
    $check = mysqli_query($conn, "
        SELECT * FROM salary 
        WHERE employee_id='$emp_id' AND month='$month' AND year='$year'
    ");

    if(mysqli_num_rows($check) > 0){
        $msg = "<div class='alert alert-danger'>Already generated</div>";
    } else {

        /* EMPLOYEE */
        $emp = mysqli_fetch_assoc(mysqli_query($conn, "
            SELECT * FROM employees WHERE emp_id='$emp_id'
        "));

        /* PAYSCALE */
        $pay = mysqli_fetch_assoc(mysqli_query($conn, "
            SELECT * FROM payscale WHERE grade='{$emp['grade']}'
        "));

        /* ATTENDANCE */
        $att = mysqli_fetch_assoc(mysqli_query($conn, "
            SELECT * FROM attendance 
            WHERE employee_id='$emp_id' AND month='$month' AND year='$year'
        "));

        if(!$att){
            $msg = "<div class='alert alert-danger'>Attendance missing</div>";
        } else {

            /* CALCULATION */
            $basic = $att['days_present'] * $pay['per_day_salary'];
            $deductions = $att['leaves'] * $pay['per_day_salary'];
            $allowances = $att['overtime_hours'] * $pay['overtime_per_hour'];
            $net = $basic + $allowances - $deductions;

            /* INSERT */
            mysqli_query($conn, "
                INSERT INTO salary 
                (employee_id, month, year, basic_salary, allowances, deductions, net_salary)
                VALUES 
                ('$emp_id','$month','$year','$basic','$allowances','$deductions','$net')
            ");

            $salary_id = mysqli_insert_id($conn);

            /* FETCH FOR PDF */
            $data = mysqli_fetch_assoc(mysqli_query($conn, "
                SELECT s.*, e.name 
                FROM salary s
                JOIN employees e ON s.employee_id = e.emp_id
                WHERE s.salary_id='$salary_id'
            "));

            /* PDF HTML */
            $html = "
            <h2 style='text-align:center;'>Salary Slip</h2>
            <hr>
            <p>Name: {$data['name']}</p>
            <p>Month: {$data['month']} {$data['year']}</p>
            <p>Basic: ₹{$data['basic_salary']}</p>
            <p>Allowances: ₹{$data['allowances']}</p>
            <p>Deductions: ₹{$data['deductions']}</p>
            <hr>
            <h3>Net Salary: ₹{$data['net_salary']}</h3>
            ";

            /* CREATE PDF */
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->render();

            if(!is_dir("salary_slips")){
                mkdir("salary_slips");
            }

            $pdfPath = "salary_slips/salary_".$salary_id.".pdf";
            file_put_contents($pdfPath, $dompdf->output());

            /* SEND EMAIL */
            if(file_exists($pdfPath)){
                sendPDFMail($emp['email'], $pdfPath);
                $msg = "<div class='alert alert-success'>Done ✔</div>";
            } else {
                $msg = "<div class='alert alert-danger'>PDF failed</div>";
            }
        }
    }
}

ob_start();
?>

<div class="card-box">
<h5>Generate Salary</h5>
<?php echo $msg; ?>

<form method="POST">
<select name="employee_id" class="form-select mb-2" required>
<option value="">Select</option>
<?php
$res = mysqli_query($conn, "SELECT * FROM employees");
while($r = mysqli_fetch_assoc($res)){
echo "<option value='{$r['emp_id']}'>{$r['name']}</option>";
}
?>
</select>

<select name="month" class="form-select mb-2">
<option>January</option><option>February</option><option>March</option>
<option>April</option><option>May</option><option>June</option>
<option>July</option><option>August</option><option>September</option>
<option>October</option><option>November</option><option>December</option>
</select>

<input type="number" name="year" class="form-control mb-2" required>

<button name="generate" class="btn btn-primary">Generate</button>
</form>
</div>

<?php
$content = ob_get_clean();
renderLayout("Generate Salary", $content);
?>