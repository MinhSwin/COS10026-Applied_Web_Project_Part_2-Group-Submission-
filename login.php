<?php session_start(); ?>
<?php require_once("settings.php"); ?>
<?php
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
<link rel="stylesheet" href="styles/login.css">

</head>

<main>

<h2>Login</h2>

<form method="POST" class="login-form">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p style="color:red;">
    <?php if (!empty($error)) { echo htmlspecialchars($error); } ?>
</p>

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