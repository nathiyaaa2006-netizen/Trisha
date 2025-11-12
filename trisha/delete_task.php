<?php
include 'dbconn.php';

$data = json_decode(file_get_contents("php://input"), true);
$task_id = $_POST['task_id'];

$sql = "DELETE FROM project_tasks WHERE task_id = '$task_id'";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
}

mysqli_close($conn);
?>
