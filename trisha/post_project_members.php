<?php
include 'dbconn.php';

$team_id    = $_POST['team_id'];
$project_id = $_POST['project_id'];
$user_id    = $_POST['user_id'];
$role       = $_POST['role'];
$added_at   = date('Y-m-d H:i:s');


$check_sql = "SELECT 1 FROM project_members WHERE team_id = ? AND project_id = ? AND user_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("iii", $team_id, $project_id, $user_id);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Duplicate member entry']);
    exit;
}

$sql = "INSERT INTO project_members (team_id, project_id, user_id, role, added_at) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiss", $team_id, $project_id, $user_id, $role, $added_at);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Member added successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Insertion failed']);
}
?>
