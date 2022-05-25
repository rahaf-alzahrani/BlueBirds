<?php
$host = "localhost";
$database = "bluebirds";
$user = "root";
$pass = "";

$error_msg = false;
$success_msg = false;

$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
    exit();
}
?>