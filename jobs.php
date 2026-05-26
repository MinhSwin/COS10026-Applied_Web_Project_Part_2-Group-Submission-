<?php
$host = "localhost";
$user = "root";
$pwd = "";
$sql_db = "jobs";

$conn = mysqli_connect("localhost", "root", "", "jobs");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$search = "";
 
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$sql = "SELECT * FROM jobs_list";

if ($search != "") {
    $sql .= " WHERE job_title LIKE '%$search%' OR reference_code LIKE '%$search%'";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jobs</title>
    <link rel="stylesheet" href="job.css">
</head>

<body>
<h1>Jobs</h1>

<form method="GET">
    <input type="text" name="search" placeholder="Search jobs..." value="<?php echo $search; ?>">
    <button type="submit">Search</button>
</form>

<h2>Jobs Avaliable:</h2>
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
    echo "No jobs found.";
}
?>
