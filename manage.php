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
?>