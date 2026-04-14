<?php include 'sidebar.php'; ?>

<link rel="stylesheet" href="style.css">

<div class="main">
<div class="container">

<div class="card">
<h2>Auto Generate Salary</h2>

<form action="auto_generate_salary.php" method="POST">

<label>Month</label>
<input type="text" name="month" required>

<label>Year</label>
<input type="number" name="year" required>

<br><br>

<button class="btn-green">Generate Salary</button>

</form>

</div>

</div>
</div>