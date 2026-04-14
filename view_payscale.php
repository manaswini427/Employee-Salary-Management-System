<?php
include("db.php");
include("layout.php");

/* FETCH DATA */
$query = mysqli_query($conn, "SELECT * FROM payscale ORDER BY grade ASC");

if(!$query){
    die("SQL ERROR: " . mysqli_error($conn));
}

ob_start();
?>

<div class="card-box">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Salary Structure (Grade-wise)</h5>
    </div>

    <!-- SEARCH -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by grade...">

    <!-- TABLE -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle" id="dataTable">

            <thead class="table-dark">
                <tr>
                    <th>Grade</th>
                    <th>Basic Salary (₹)</th>
                    <th>Per Day Salary (₹)</th>
                    <th>Overtime / Hour (₹)</th>
                </tr>
            </thead>

            <tbody>
                <?php if(mysqli_num_rows($query) > 0){ ?>
                    <?php while($row = mysqli_fetch_assoc($query)){ ?>
                        <tr>
                            <td><span class="badge bg-primary"><?php echo $row['grade']; ?></span></td>
                            <td>₹<?php echo number_format($row['basic_salary'],2); ?></td>
                            <td>₹<?php echo number_format($row['per_day_salary'],2); ?></td>
                            <td>₹<?php echo number_format($row['overtime_per_hour'],2); ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="4">No Payscale Data Found</td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>

</div>

<!-- SEARCH SCRIPT (SAFE INLINE VERSION) -->
<script>
document.getElementById("searchInput").addEventListener("keyup", function(){
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#dataTable tbody tr");

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
});
</script>

<?php
$content = ob_get_clean();
renderLayout("Salary Structure", $content);
?>