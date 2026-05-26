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

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>

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

</body>
</html>
