<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "WorkCluster");
if ($conn->connect_error) {
    die(json_encode(["error" => "DB connection failed: " . $conn->connect_error]));
}

$id = 1;  // Hardcoded for demo
$result = $conn->query("DELETE FROM view WHERE id = $id");

if ($result) {
    echo json_encode(["message" => "Account deleted successfully"]);
} else {
    echo json_encode(["error" => "Failed to delete account"]);
}
$conn->close();
?>
