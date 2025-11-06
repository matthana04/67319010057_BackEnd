<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "online_shop";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตั้งค่า timezone
date_default_timezone_set("Asia/Bangkok");
?>
