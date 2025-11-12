<?php
include 'dbconn.php';

$sql = "SELECT task_id, project_id, title, description, assigned_to, status, due_date, created_at FROM project_tasks";
$result = mysqli_query($conn, $sql);

$tasks = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tasks[] = $row;
    }
    echo json_encode($tasks);
} else {
    echo json_encode(["error" => "Failed to fetch tasks"]);
}

mysqli_close($conn);
?>
