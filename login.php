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

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE username = ?");

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        if (password_verify($password, $row["password_hash"])) {

            $_SESSION["user_id"] = $row["id"];

            header("Location: manage.php");
            exit();
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "User not found";
    }
}
?>
<?php include 'header.inc'; ?>

<body>

<h2>Login</h2>

<form method="POST">

    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>

</form>

<p style="color:red;">
    <?php echo $error; ?>
</p>

<!-- This acknowledgement is included to meet the assignment requirement.
     It is placed on the homepage so it is visible to all visitors. -->
<section class="acknowledgement">
    <h2>Acknowledgement of Country</h2>
    <p>
        We acknowledge the Traditional Owners of the land on which we operate and pay our respects 
        to Elders past, present and emerging. We are committed to supporting Aboriginal and Torres 
        Strait Islander peoples through inclusive employment and sustainable partnerships.
    </p>
</section>

<?php include 'footer.inc'; ?>

</body>
</html>
