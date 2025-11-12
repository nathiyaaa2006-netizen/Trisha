<?php
$host = "localhost";
$user = "root";  // Default XAMPP user
$pass = "";      // Default XAMPP password (empty)
$db   = "workcluster";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
