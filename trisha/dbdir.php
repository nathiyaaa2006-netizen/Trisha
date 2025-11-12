<?php
$host = "localhost";
$user = "root"; // XAMPP default
$password = ""; // XAMPP default
$dbname = "workcluster";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
