<?php
include 'db_configemp.php';

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$full_name = $data['full_name'];
$designation = $data['designation'];
$date_of_birth = $data['date_of_birth'];
$tag_code = $data['tag_code'];
$phone_number = $data['phone_number'];
$email_address = $data['email_address'];
$system_image = $data['system_image'];

$sql = "UPDATE employees SET 
    full_name='$full_name',
    designation='$designation',
    date_of_birth='$date_of_birth',
    tag_code='$tag_code',
    phone_number='$phone_number',
    email_address='$email_address',
    system_image='$system_image'
    WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}

$conn->close();
?>
