<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$host = "localhost";
$db = "WorkCluster"; // Your existing DB name
$user = "root";
$pass = "";  // default XAMPP password

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "DB connection failed"]));
}

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';
$role = $data['role'] ?? '';

if (empty($email) || empty($password) || empty($role)) {
    echo json_encode(["status" => "error", "message" => "All fields are required"]);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM users WHERE role = ? AND email = ? AND password = ?");
$stmt->bind_param("sss", $role, $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["status" => "success", "message" => "Login successful", "role" => $role]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
}

$stmt->close();
$conn->close();
?>
