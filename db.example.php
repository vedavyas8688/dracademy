<?php
$host = "localhost";
$user = "your_database_user";
$pass = "your_database_password";
$dbname = "your_database_name";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Database connection failed");
}

$conn->set_charset("utf8mb4");
?>
