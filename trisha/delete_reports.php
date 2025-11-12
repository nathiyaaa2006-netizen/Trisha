<?php
include 'dbconn.php';

$data = json_decode(file_get_contents("php://input"), true);
$s_no = $_POST['s_no'];
$user_id = $_POST['user_id'];

$sql = "DELETE FROM reports WHERE s_no = '$s_no'AND user_id = '$user_id'";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
}

mysqli_close($conn);
?>
