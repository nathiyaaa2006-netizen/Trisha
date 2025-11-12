<?php
include 'dbconn.php';

$project_id = rand(100, 999); 
$name = $_POST['name'];
$description = $_POST['description'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$status = $_POST['status'];
$user_id = $_POST['user_id'];
$created_at = date('Y-m-d H:i:s');

$sql = "INSERT INTO projects (project_id, name, description, start_date, end_date, status, user_id, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssssis", $project_id, $name, $description, $start_date, $end_date, $status, $user_id, $created_at);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'project_id' => $project_id]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Insertion failed']);
}
?>
