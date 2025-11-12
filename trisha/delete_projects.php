<?php
include 'dbconn.php';

$project_id = $_POST['project_id'];

$sql = "DELETE FROM projects WHERE project_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $project_id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Deletion failed']);
}
?>
