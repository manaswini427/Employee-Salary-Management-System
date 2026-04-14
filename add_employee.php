<?php
include("db.php");
include("layout.php");

$msg = "";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dept = $_POST['department'];
    $grade = $_POST['grade'];

    $insert = mysqli_query($conn, "INSERT INTO employees (name,email,department,grade)
    VALUES ('$name','$email','$dept','$grade')");

    if($insert){
        $msg = "<div class='alert alert-success'>Employee Added Successfully</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Error Adding Employee</div>";
    }
}

ob_start();
?>

<div class="card-box">

    <h5 class="mb-3">Add New Employee</h5>

    <?php echo $msg; ?>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Employee Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Department</label>
            <input type="text" name="department" class="form-control" placeholder="Enter department" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Grade</label>
            <input type="text" name="grade" class="form-control" placeholder="Enter grade (A, B, C)" required>
        </div>

        <button type="submit" name="submit" class="btn btn-custom">
            <i class="fa fa-plus"></i> Add Employee
        </button>

    </form>

</div>

<?php
$content = ob_get_clean();
renderLayout("Add Employee", $content);
?>