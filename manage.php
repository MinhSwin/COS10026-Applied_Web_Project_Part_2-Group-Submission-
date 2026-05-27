<?php
session_start();
$host = "localhost";
$user = "root";
$pwd = "";
$sql_db = "jobs";

$conn = mysqli_connect("localhost", "root", "", "jobs");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION["user_id"])) {
    header("Location:login.php");
    exit();
}

function sanitise_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$message = "";
$results = null;

$allowed_sort_fields = ["EOInumber", "job_reference", "first_name", "last_name", "status"];
$sort_field = "EOInumber";

if (isset($_GET["sort"]) && in_array($_GET["sort"], $allowed_sort_fields)) {
    $sort_field = $_GET["sort"];
}

/* List all EOIs */
if (isset($_GET["list_all"])) {
    $query = "SELECT * FROM eoi ORDER BY $sort_field";
    $results = mysqli_query($conn, $query);
}

/* Search EOIs */
if (isset($_GET["search"])) {
    $job_reference = sanitise_input($_GET["job_reference"]);
    $first_name = sanitise_input($_GET["first_name"]);
    $last_name = sanitise_input($_GET["last_name"]);

    $query = "SELECT * FROM eoi WHERE 1=1";
    $params = [];
    $types = "";

    if ($job_reference != "") {
        $query .= " AND job_reference = ?";
        $params[] = $job_reference;
        $types .= "s";
    }

    if ($first_name != "") {
        $query .= " AND first_name = ?";
        $params[] = $first_name;
        $types .= "s";
    }

    if ($last_name != "") {
        $query .= " AND last_name = ?";
        $params[] = $last_name;
        $types .= "s";
    }

    $query .= " ORDER BY $sort_field";

    $stmt = mysqli_prepare($conn, $query);

    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
}

/* Delete EOIs by job reference */
if (isset($_POST["delete"])) {
    $delete_reference = sanitise_input($_POST["delete_reference"]);

    if ($delete_reference != "") {
        $stmt = mysqli_prepare($conn, "DELETE FROM eoi WHERE job_reference = ?");
        mysqli_stmt_bind_param($stmt, "s", $delete_reference);
        mysqli_stmt_execute($stmt);

        $message = "All EOIs for job reference " . htmlspecialchars($delete_reference) . " have been deleted.";
    } else {
        $message = "Please enter a job reference to delete EOIs.";
    }
}

/* Update EOI status */
if (isset($_POST["update_status"])) {
    $eoi_number = sanitise_input($_POST["eoi_number"]);
    $new_status = sanitise_input($_POST["new_status"]);

    $allowed_status = ["New", "Current", "Final"];

    if ($eoi_number != "" && in_array($new_status, $allowed_status)) {
        $stmt = mysqli_prepare($conn, "UPDATE eoi SET status = ? WHERE EOInumber = ?");
        mysqli_stmt_bind_param($stmt, "si", $new_status, $eoi_number);
        mysqli_stmt_execute($stmt);

        $message = "EOI number " . htmlspecialchars($eoi_number) . " has been updated to " . htmlspecialchars($new_status) . ".";
    } else {
        $message = "Please enter a valid EOI number and status.";
    }
}

?>

<?php include 'header.inc'; ?>

<main>

    <?php
    if ($message != "") {
        echo "<p><strong>" . $message . "</strong></p>";
    }
    ?>

    <section>
        <h2>List All EOIs</h2>
        <form method="get" action="manage.php">
            <label for="sort_all">Sort by:</label>
            <select name="sort" id="sort_all">
                <option value="EOInumber">EOI Number</option>
                <option value="job_reference">Job Reference</option>
                <option value="first_name">First Name</option>
                <option value="last_name">Last Name</option>
                <option value="status">Status</option>
            </select>

            <input type="submit" name="list_all" value="List All EOIs">
        </form>
    </section>

    <section>
        <h2>Search EOIs</h2>
        <form method="get" action="manage.php">
            <p>
                <label for="job_reference">Job reference:</label>
                <input type="text" id="job_reference" name="job_reference">
            </p>

            <p>
                <label for="first_name">First name:</label>
                <input type="text" id="first_name" name="first_name">
            </p>

            <p>
                <label for="last_name">Last name:</label>
                <input type="text" id="last_name" name="last_name">
            </p>

            <p>
                <label for="sort_search">Sort by:</label>
                <select name="sort" id="sort_search">
                    <option value="EOInumber">EOI Number</option>
                    <option value="job_reference">Job Reference</option>
                    <option value="first_name">First Name</option>
                    <option value="last_name">Last Name</option>
                    <option value="status">Status</option>
                </select>
            </p>

            <input type="submit" name="search" value="Search EOIs">
        </form>
    </section>

    <section>
        <h2>Delete EOIs by Job Reference</h2>
        <form method="post" action="manage.php">
            <label for="delete_reference">Job reference:</label>
            <input type="text" id="delete_reference" name="delete_reference" required>
            <input type="submit" name="delete" value="Delete EOIs">
        </form>
    </section>

    <section>
        <h2>Change EOI Status</h2>
        <form method="post" action="manage.php">
            <p>
                <label for="eoi_number">EOI number:</label>
                <input type="number" id="eoi_number" name="eoi_number" required>
            </p>

            <p>
                <label for="new_status">New status:</label>
                <select id="new_status" name="new_status" required>
                    <option value="New">New</option>
                    <option value="Current">Current</option>
                    <option value="Final">Final</option>
                </select>
            </p>

            <input type="submit" name="update_status" value="Update Status">
        </form>
    </section>

    <section>
        <h2>Results</h2>

        <?php
        if ($results && mysqli_num_rows($results) > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>EOI Number</th>";
            echo "<th>Job Reference</th>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Date of Birth</th>";
            echo "<th>Gender</th>";
            echo "<th>Street Address</th>";
            echo "<th>Suburb</th>";
            echo "<th>State</th>";
            echo "<th>Postcode</th>";
            echo "<th>Email</th>";
            echo "<th>Phone</th>";
            echo "<th>Skills</th>";
            echo "<th>Other Skills</th>";
            echo "<th>Status</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($results)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["EOInumber"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["job_reference"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["first_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["last_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["date_of_birth"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["gender"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["street_address"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["suburb"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["state"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["postcode"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["skills"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["other_skills"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No EOI records to display.</p>";
        }
        ?>

    </section>

</main>

<?php include 'footer.inc'; ?>

</body>
</html>

<?php
mysqli_close($conn);
?>