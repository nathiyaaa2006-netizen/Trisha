<?php
include 'dbconn.php';

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $_POST['user_id'];
$content = $_POST['content'];
$status = $_POST['status'];

$sql = "INSERT INTO reports (user_id, date, content, status, created_at)
        VALUES ('$user_id', CURDATE(), '$content', '$status', NOW())";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["success" => true, "message" => "Report added successfully."]);
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
}

mysqli_close($conn);
?>
