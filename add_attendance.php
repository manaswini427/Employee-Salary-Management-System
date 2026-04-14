<?php
include("db.php");
include("layout.php");

$msg = "";

/* INSERT ATTENDANCE */
if(isset($_POST['submit'])){
    $emp_id = $_POST['employee_id'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $present = $_POST['days_present'];
    $total_days = $_POST['total_days'];
    $leaves = $_POST['leaves'];
    $overtime = $_POST['overtime'];

    // Prevent duplicate entry
    $check = mysqli_query($conn, "SELECT * FROM attendance 
        WHERE employee_id='$emp_id' AND month='$month' AND year='$year'");

    if(mysqli_num_rows($check) > 0){
        $msg = "<div class='alert alert-danger'>Attendance already exists for this employee/month</div>";
    } else {

        mysqli_query($conn, "INSERT INTO attendance 
        (employee_id, month, year, days_present, Total_working_days, leaves, overtime_hours)
        VALUES 
        ('$emp_id','$month','$year','$present','$total_days','$leaves','$overtime')");

        $msg = "<div class='alert alert-success'>Attendance Added Successfully</div>";
    }
}

/* FETCH EMPLOYEES */
$employees = mysqli_query($conn, "SELECT * FROM employees");

ob_start();
?>

<div class="card-box">

    <h5 class="mb-3">Add Attendance</h5>

    <?php echo $msg; ?>

    <form method="POST">

        <div class="row">

            <div class="col-md-4 mb-3">
                <label>Employee</label>
                <select name="employee_id" class="form-select" required>
                    <option value="">Select Employee</option>
                    <?php while($emp = mysqli_fetch_assoc($employees)){ ?>
                        <option value="<?php echo $emp['emp_id']; ?>">
                            <?php echo $emp['name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-4 mb-3">
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

            <div class="col-md-4 mb-3">
                <label>Year</label>
                <input type="number" name="year" class="form-control" value="<?php echo date('Y'); ?>" required>
            </div>

            <div class="col-md-3 mb-3">
                <label>Total Working Days</label>
                <input type="number" name="total_days" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label>Days Present</label>
                <input type="number" name="days_present" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label>Leaves</label>
                <input type="number" name="leaves" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label>Overtime Hours</label>
                <input type="number" name="overtime" class="form-control" required>
            </div>

        </div>

        <button type="submit" name="submit" class="btn btn-custom">
            <i class="fa fa-save"></i> Save Attendance
        </button>

    </form>

</div>

<?php
$content = ob_get_clean();
renderLayout("Attendance Management", $content);
?>