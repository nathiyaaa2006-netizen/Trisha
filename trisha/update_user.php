<?php
header("Content-Type: application/json");

// Database Connection
$servername = "localhost";
$username = "root";      // XAMPP default
$password = "";          // XAMPP default
$dbname = "WorkCluster";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

// Get JSON data from request
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $fullName = $conn->real_escape_string($data['fullName']);
    $designation = $conn->real_escape_string($data['designation']);
    $dateOfBirth = $conn->real_escape_string($data['dateOfBirth']);
    $tagCode = $conn->real_escape_string($data['tagCode']);
    $phoneNumber = $conn->real_escape_string($data['phoneNumber']);
    $emailAddress = $conn->real_escape_string($data['emailAddress']);
    $password = password_hash($data['password'], PASSWORD_DEFAULT); // Hash Password
    
    // Check if user exists by email
    $checkQuery = "SELECT * FROM user WHERE email_address='$emailAddress'";
    $result = $conn->query($checkQuery);
    
    if ($result->num_rows > 0) {
        // Update existing user
        $updateQuery = "UPDATE user SET 
            full_name='$fullName',
            designation='$designation',
            date_of_birth='$dateOfBirth',
            tag_code='$tagCode',
            phone_number='$phoneNumber',
            password='$password'
            WHERE email_address='$emailAddress'";
        
        if ($conn->query($updateQuery) === TRUE) {
            echo json_encode(["success" => true, "message" => "Profile updated successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error updating user: " . $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "User not found."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid JSON data received."]);
}

$conn->close();
?>
