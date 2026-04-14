<?php
session_start();
include("db.php");

$error = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // QUERY
    $query = mysqli_query($conn, "
        SELECT * FROM admin 
        WHERE username='$username' AND password='$password'
    ");

    // DEBUG (IMPORTANT)
    if(!$query){
        die("SQL ERROR: " . mysqli_error($conn));
    }

    // CHECK LOGIN
    if(mysqli_num_rows($query) > 0){
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }
        .login-box{
            width:400px;
            margin:100px auto;
            padding:30px;
            background:white;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

<div class="login-box">

    <h3 class="text-center mb-4">Salary Management System</h3>

    <?php if($error){ ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" name="login" class="btn btn-primary w-100">
            Login
        </button>

    </form>

</div>

</body>
</html>