<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "WorkCluster");
if ($conn->connect_error) {
    die(json_encode(["error" => "DB connection failed: " . $conn->connect_error]));
}

// For demo: Hardcoded ID (you can replace with authentication later)
$id = 1;

$result = $conn->query("SELECT * FROM users WHERE id = $id");
if ($result && $row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode(["error" => "User not found"]);
}
$conn->close();
?>
