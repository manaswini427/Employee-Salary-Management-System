<!DOCTYPE html>
<html>
<head>
    <title>Employee Salary Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }

        .container {
            text-align: center;
        }

        h1 {
            font-size: 40px;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            margin-bottom: 40px;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 18px;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .login-btn {
            background: #ff6b6b;
            color: white;
        }

        .login-btn:hover {
            background: #ff4757;
            transform: scale(1.05);
        }

        .about-btn {
            background: #1dd1a1;
            color: white;
        }

        .about-btn:hover {
            background: #10ac84;
            transform: scale(1.05);
        }

        footer {
            position: absolute;
            bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Employee Salary Management System</h1>
    <p>Efficient • Secure • Automated Payroll Processing</p>

    <a href="login.php" class="btn login-btn">Admin Login</a>
    <a href="#" class="btn about-btn">About Project</a>
</div>

<footer>
    © 2026 | Developed by Team
</footer>

</body>
</html>
