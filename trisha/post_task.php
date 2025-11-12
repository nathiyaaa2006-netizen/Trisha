<?php
include 'dbconn.php';

$data = json_decode(file_get_contents("php://input"), true);

$project_id = $_POST['project_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$assigned_to = $_POST['assigned_to'];
$status = $_POST['status'];
$due_date = $_POST['due_date'];

$sql = "INSERT INTO project_tasks (project_id, title, description, assigned_to, status, due_date, created_at) 
        VALUES ('$project_id', '$title', '$description', '$assigned_to', '$status', '$due_date', NOW())";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["success" => true, "task_id" => mysqli_insert_id($conn)]);
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
}

mysqli_close($conn);
?>
