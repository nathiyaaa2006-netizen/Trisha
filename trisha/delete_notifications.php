<?php
include 'dbconn.php';

$notification_id = $_POST['notification_id'];

$sql = "DELETE FROM notifications WHERE notification_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $notification_id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Delete failed']);
}
?>
