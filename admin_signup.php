<?php
$host = "localhost";
$user = "root";
$pwd = "";
$sql_db = "jobs";

$conn = mysqli_connect("localhost", "root", "", "jobs");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = "admin";
$password = "admin";

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hash);
$stmt->execute();

echo "Admin user created successfully";