<?php
include 'db_config.php';

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($user_id > 0) {
    $sql = "SELECT * FROM user_profiles WHERE user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode(["success" => true, "profile" => $result->fetch_assoc()]);
    } else {
        echo json_encode(["success" => false, "message" => "Profile not found"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid user ID"]);
}
?>
