<?php
include 'db_config.php';

$data = json_decode(file_get_contents("php://input"), true);
$user_id = intval($data['user_id'] ?? 0);

if ($user_id > 0) {
    $project_updates = $data['project_updates'] ? 1 : 0;
    $casting_calls = $data['casting_calls'] ? 1 : 0;
    $collaboration_requests = $data['collaboration_requests'] ? 1 : 0;
    $profile_visibility = $conn->real_escape_string($data['profile_visibility']);
    $portfolio_access = $conn->real_escape_string($data['portfolio_access']);
    $contact_information = $conn->real_escape_string($data['contact_information']);

    $sql = "UPDATE user_profiles 
            SET project_updates = $project_updates, 
                casting_calls = $casting_calls, 
                collaboration_requests = $collaboration_requests,
                profile_visibility = '$profile_visibility',
                portfolio_access = '$portfolio_access',
                contact_information = '$contact_information'
            WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Profile updated successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update profile"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid user ID"]);
}
?>
