<?php
include 'dbconn.php';

$user_id = $_POST['user_id'];
$message = $_POST['message'];
$is_read = 0;
$created_at = date('Y-m-d H:i:s');

do {
    $notification_id = rand(100, 999);
    $check_sql = "SELECT 1 FROM notifications WHERE notification_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $notification_id);
    $check_stmt->execute();
    $check_stmt->store_result();
} while ($check_stmt->num_rows > 0);

$sql = "INSERT INTO notifications (user_id, notification_id, message, is_read, created_at) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iisss", $user_id, $notification_id, $message, $is_read, $created_at);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'notification_id' => $notification_id]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Insertion failed']);
}
?>
