<?php
include 'dbconn.php';

$team_id = $_POST['team_id'];

$sql = "DELETE FROM project_members WHERE team_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $team_id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Deleted successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Deletion failed']);
}
?>
    