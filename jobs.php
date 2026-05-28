<?php require_once("settings.php"); ?>
<?php include 'header.inc'; ?>
<link rel="stylesheet" href="styles/jobs.css">
<main>
 
<?php
$search = "";
 
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
 
if ($search != "") {
    $stmt = $conn->prepare("SELECT * FROM jobs_list WHERE job_title LIKE ? OR reference_code LIKE ?");
    $like = "%" . $search . "%";
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = mysqli_query($conn, "SELECT * FROM jobs_list");
}
?>
 
<h1>Jobs</h1>
 
<form method="GET">
    <input type="text" name="search" placeholder="Search jobs..." value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">Search</button>
</form>
 
<h2>Jobs Available:</h2>

<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='job'>";
        echo "<h2>" . $row['job_title'] . "</h2>";

        echo "<p><b>Reference:</b> " . $row['reference_code'] . "</p>";
        echo "<p><b>Description:</b> " . $row['description'] . "</p>";
        echo "<p><b>Salary:</b> " . $row['salary'] . "</p>";
        echo "<p><b>Report to:</b> " . $row['report_to'] . "</p>";

        echo "</div>";

        echo "<hr>";
    }
} else {
    echo "<p>No jobs found.</p>";
}
?>
 
<section class="acknowledgement">
    <h2>Acknowledgement of Country</h2>
    <p>
        We acknowledge the Traditional Owners of the land on which we operate and pay our respects 
        to Elders past, present and emerging. We are committed to supporting Aboriginal and Torres 
        Strait Islander peoples through inclusive employment and sustainable partnerships.
        
    </p>

</section>
     <br>
</main>
 
<?php include 'footer.inc'; ?>
