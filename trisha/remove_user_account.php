<?php
include 'db_config.php';

$data = json_decode(file_get_contents("php://input"), true);
$user_id = intval($data['user_id'] ?? 0);

if ($user_id > 0) {
    // Delete profile first due to foreign key constraint
    $conn->query("DELETE FROM user_profiles WHERE user_id = $user_id");

    // Delete user account
    $sql = "DELETE FROM users WHERE id = $user_id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Account deleted successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete account"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid user ID"]);
}
?>
