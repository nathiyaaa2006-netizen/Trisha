<?php
include 'dbconn.php';

$user_id = $_POST['user_id'];
$user_type = $_POST['user_type'];
$password = $_POST['password'];

$sql = "SELECT user_id, user_type, password_hash FROM users WHERE user_id = ? AND user_type = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user_id , $user_type);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password_hash'])) {
        echo json_encode(['status' => 'success', 'user_id' => $row['user_id'], 'user_type' => $row['user_type']]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid password']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
}
?>
