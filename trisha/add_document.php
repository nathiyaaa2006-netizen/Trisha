<?php
include 'db.php';

$name = $_POST['name'];
$size = $_POST['size'];
$date_uploaded = $_POST['date_uploaded'];
$icon = $_POST['icon'];

$sql = "INSERT INTO documents (name, size, date_uploaded, icon) 
        VALUES ('$name', '$size', '$date_uploaded', '$icon')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}
?>
