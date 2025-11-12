<?php
include 'dbconn.php';

$sql = "SELECT s_no, user_id, notification_id, message, is_read, created_at FROM notifications";
$result = $conn->query($sql);

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

echo json_encode($notifications);
?>
