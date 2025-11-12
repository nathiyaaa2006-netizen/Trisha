<?php
header("Content-Type: application/json");

// DB Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WorkCluster";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "DB Connection failed"]));
}

// Read JSON data
$data = json_decode(file_get_contents("php://input"), true);

// Validate & Save
if ($data) {
    $fullName = $conn->real_escape_string($data['fullName']);
    $designation = $conn->real_escape_string($data['designation']);
    $dateOfBirth = $conn->real_escape_string($data['dateOfBirth']);
    $tagCode = $conn->real_escape_string($data['tagCode']);
    $phoneNumber = $conn->real_escape_string($data['phoneNumber']);
    $emailAddress = $conn->real_escape_string($data['emailAddress']);
    $password = $conn->real_escape_string($data['password']);
    
    // Example Query (Here we just print for demo)
    // You can implement INSERT/UPDATE query as needed
    echo json_encode([
        "success" => true,
        "message" => "Profile updated successfully",
        "data" => $data
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid Data"]);
}

$conn->close();
?>
