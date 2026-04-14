<?php
include("db.php");
include("layout.php");

$msg = "";

/* DELETE */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM employees WHERE emp_id='$id'");
    header("Location: manage_employee.php");
    exit();
}

/* UPDATE */
if(isset($_POST['update'])){
    $id = $_POST['emp_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dept = $_POST['department'];
    $grade = $_POST['grade'];

    mysqli_query($conn, "UPDATE employees 
        SET name='$name', email='$email', department='$dept', grade='$grade'
        WHERE emp_id='$id'");

    $msg = "<div class='alert alert-success'>Employee Updated Successfully</div>";
}

/* FETCH FOR EDIT */
$editData = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $res = mysqli_query($conn, "SELECT * FROM employees WHERE emp_id='$id'");
    $editData = mysqli_fetch_assoc($res);
}

/* FETCH ALL */
$employees = mysqli_query($conn, "SELECT * FROM employees ORDER BY emp_id DESC");

ob_start();
?>

<div class="card-box">

    <h5 class="mb-3">Manage Employees</h5>

    <?php echo $msg; ?>

    <!-- EDIT FORM -->
    <?php if($editData){ ?>
        <form method="POST" class="mb-4">
            <input type="hidden" name="emp_id" value="<?php echo $editData['emp_id']; ?>">

            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="name" value="<?php echo $editData['name']; ?>" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <input type="email" name="email" value="<?php echo $editData['email']; ?>" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <input type="text" name="department" value="<?php echo $editData['department']; ?>" class="form-control" required>
                </div>

                <div class="col-md-2">
                    <input type="text" name="grade" value="<?php echo $editData['grade']; ?>" class="form-control" required>
                </div>

                <div class="col-md-1">
                    <button type="submit" name="update" class="btn btn-custom">
                        ✔
                    </button>
                </div>
            </div>
        </form>
    <?php } ?>

    <!-- TABLE -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Grade</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php while($row = mysqli_fetch_assoc($employees)){ ?>
                <tr>
                    <td><?php echo $row['emp_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['grade']; ?></td>
                    <td>
                        <a href="?edit=<?php echo $row['emp_id']; ?>" class="btn btn-sm btn-warning">
                            <i class="fa fa-edit"></i>
                        </a>

                        <a href="?delete=<?php echo $row['emp_id']; ?>" 
                           onclick="return confirm('Delete this employee?')" 
                           class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php
$content = ob_get_clean();
renderLayout("Manage Employees", $content);
?>