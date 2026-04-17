<?php
include("db.php");
include("layout.php");
include_once("send_mail.php");

/* DOMPDF */
require 'dompdf/autoload.inc.php';
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
        $msg = "<div class='alert alert-danger'>Salary already generated!</div>";
    } else {

        /* FETCH EMPLOYEE */
        $emp = mysqli_fetch_assoc(mysqli_query($conn, "
            SELECT * FROM employees WHERE emp_id='$emp_id'
        "));

        $grade = $emp['grade'];

        /* FETCH PAYSCALE */
        $pay = mysqli_fetch_assoc(mysqli_query($conn, "
            SELECT * FROM payscale WHERE grade='$grade'
        "));

        /* FETCH ATTENDANCE */
        $att = mysqli_fetch_assoc(mysqli_query($conn, "
            SELECT * FROM attendance 
            WHERE employee_id='$emp_id' AND month='$month' AND year='$year'
        "));

        if(!$att){
            $msg = "<div class='alert alert-danger'>Attendance not found!</div>";
        } else {

            /* CALCULATIONS */
            $per_day = $pay['per_day_salary'];
            $overtime_rate = $pay['overtime_per_hour'];

            $basic = $att['days_present'] * $per_day;
            $deductions = $att['leaves'] * $per_day;
            $allowances = $att['overtime_hours'] * $overtime_rate;

            $net = $basic + $allowances - $deductions;

            /* INSERT SALARY */
            mysqli_query($conn, "
                INSERT INTO salary 
                (employee_id, month, year, basic_salary, allowances, deductions, net_salary)
                VALUES 
                ('$emp_id','$month','$year','$basic','$allowances','$deductions','$net')
            ");

            /* GET LAST INSERTED ID */
            $salary_id = mysqli_insert_id($conn);

            /* FETCH DATA FOR PDF */
            $data = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT s.*, e.name 
    FROM salary s
    JOIN employees e ON s.employee_id = e.emp_id
    WHERE s.salary_id='$salary_id'
"));

            /* HTML FOR PDF */
            $html = "
            <h2 style='text-align:center;'>Salary Slip</h2>
            <hr>
            <p><b>Name:</b> {$data['name']}</p>
            <p><b>Month:</b> {$data['month']} {$data['year']}</p>
            <p><b>Basic:</b> ₹{$data['basic_salary']}</p>
            <p><b>Allowances:</b> ₹{$data['allowances']}</p>
            <p><b>Deductions:</b> ₹{$data['deductions']}</p>
            <hr>
            <h3>Net Salary: ₹{$data['net_salary']}</h3>
            ";

            /* CREATE PDF */
            $dompdf = new \Dompdf\Dompdf();   
            $dompdf->loadHtml($html);
            $dompdf->render();

            /* CREATE FOLDER */
            if(!is_dir("salary_slips")){
                mkdir("salary_slips");
            }

            /* SAVE PDF */
            $pdfPath = "salary_slips/salary_".$salary_id.".pdf";
            file_put_contents($pdfPath, $dompdf->output());

            /* SEND EMAIL WITH PDF */
            sendPDFMail($emp['email'], $pdfPath);

            $msg = "<div class='alert alert-success'>Salary Generated, PDF Created & Sent!</div>";
        }
    }
}

ob_start();
?>

<div class="card-box">

    <h5 class="mb-3">Generate Salary</h5>

    <?php echo $msg; ?>

    <form method="POST">

        <div class="mb-3">
            <label>Select Employee</label>
            <select name="employee_id" class="form-select" required>
                <option value="">Select</option>
                <?php
                $res = mysqli_query($conn, "SELECT * FROM employees");
                while($row = mysqli_fetch_assoc($res)){
                    echo "<option value='{$row['emp_id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Month</label>
            <select name="month" class="form-select" required>
                <option>January</option>
                <option>February</option>
                <option>March</option>
                <option>April</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>August</option>
                <option>September</option>
                <option>October</option>
                <option>November</option>
                <option>December</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Year</label>
            <input type="number" name="year" class="form-control" required>
        </div>

        <button type="submit" name="generate" class="btn btn-custom">
            Generate Salary
        </button>

    </form>

</div>

<?php
$content = ob_get_clean();
renderLayout("Generate Salary", $content);
?>
