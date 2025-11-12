<?php

include 'dbconn.php';

if (!isset($_POST['user_id'])) {
    die("user_id is required.");
}

$user_id = $_POST['user_id'];
$fields = ['user_type', 'full_name', 'email', 'phone_number', 'password', 'date_of_birth', 'gender',
    'marital_status', 'nationality', 'permanent_address', 'current_address', 'employee_id', 'job_title',
    'department', 'date_of_joining', 'employee_type', 'reporting_to', 'highest_qualification', 'year_of_passing',
    'university', 'specialization', 'previous_companies', 'designations', 'duration', 'skills_used',
    'bank_name', 'account_number', 'ifsc_code', 'pan_card_number', 'aadhaar_number', 'passport_number',
    'emergency_contact_name', 'emergency_contact_phone', 'emergency_contact_relationship', 'emergency_contact_address'];

$setClauses = [];
$params = [];
$types = "";

foreach ($fields as $field) {
    if (isset($_POST[$field])) {
        $value = $_POST[$field];

        if ($field == 'password') {
            $setClauses[] = "password_hash = ?";
            $params[] = password_hash($value, PASSWORD_BCRYPT);
            $types .= "s";
        } else {
            $setClauses[] = "$field = ?";
            $params[] = $value;
            $types .= "s";
        }
    }
}

if (empty($setClauses)) {
    die("No fields to update.");
}


$sql = "UPDATE users SET " . implode(", ", $setClauses) . " WHERE user_id = ?";
$params[] = $user_id;
$types .= "s";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    echo "User updated successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
