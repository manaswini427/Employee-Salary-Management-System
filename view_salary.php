<?php
include("db.php");
include("layout.php");

$month = "";
$year = "";
$where = "";

/* FILTER */
if(isset($_POST['filter'])){
    $month = $_POST['month'];
    $year = $_POST['year'];

    $where = "WHERE s.month='$month' AND s.year='$year'";
}

/* QUERY */
$sql = "
    SELECT s.*, e.name 
    FROM salary s
    JOIN employees e ON s.employee_id = e.emp_id
    $where
    ORDER BY s.employee_id DESC
";

$query = mysqli_query($conn, $sql);

/* ERROR CHECK */
if(!$query){
    die("SQL ERROR: " . mysqli_error($conn));
}

ob_start();
?>

<div class="card-box">

    <h5 class="mb-3">Salary Records</h5>

    <!-- FILTER -->
    <form method="POST" class="mb-4">
        <div class="row">

            <div class="col-md-4">
                <select name="month" class="form-select" required>
                    <option value="">Select Month</option>
                    <?php 
                    $months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                    foreach($months as $m){
                        $selected = ($month == $m) ? "selected" : "";
                        echo "<option $selected>$m</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-4">
                <input type="number" name="year" class="form-control"
                       placeholder="Year" value="<?php echo $year; ?>" required>
            </div>

            <div class="col-md-4">
                <button type="submit" name="filter" class="btn btn-custom w-100">
                    <i class="fa fa-filter"></i> Filter
                </button>
            </div>

        </div>
    </form>

    <!-- TABLE -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Emp ID</th>
                <th>Employee</th>
                <th>Month</th>
                <th>Year</th>
                <th>Basic</th>
                <th>Allowances</th>
                <th>Deductions</th>
                <th>Net Salary</th>
                <th>Slip</th>
            </tr>
        </thead>

        <tbody>

        <?php if(mysqli_num_rows($query) > 0){ ?>
            <?php while($row = mysqli_fetch_assoc($query)){ ?>
                <tr>
                    <td><?php echo $row['employee_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['month']; ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td>₹<?php echo $row['basic_salary']; ?></td>
                    <td>₹<?php echo $row['allowances']; ?></td>
                    <td>₹<?php echo $row['deductions']; ?></td>
                    <td><strong>₹<?php echo $row['net_salary']; ?></strong></td>

                    <!-- PDF BUTTON -->
                    <td>
                        <a href="generate_pdf.php?emp_id=<?php echo $row['employee_id']; ?>&month=<?php echo $row['month']; ?>&year=<?php echo $row['year']; ?>" 
                           class="btn btn-sm btn-primary" target="_blank">
                            <i class="fa fa-download"></i> PDF
                        </a>
                    </td>

                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="9" class="text-center">No Records Found</td>
            </tr>
        <?php } ?>

        </tbody>
    </table>

</div>

<?php
$content = ob_get_clean();
renderLayout("Salary Records", $content);
?>