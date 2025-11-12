<?php
include 'dbconn.php';

$sql = "SELECT s_no, project_id, name, description, start_date, end_date, status, user_id, created_at FROM projects";
$result = $conn->query($sql);

$projects = [];
while ($row = $result->fetch_assoc()) {
    $projects[] = $row;
}

echo json_encode($projects);
?>
