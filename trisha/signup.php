<?php
// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'dbconn.php';

// Set response header
header('Content-Type: application/json');

// Check if all required form fields are set
$required = ['name', 'email', 'mobile_number', 'password', 'user_type'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['status' => 'error', 'message' => "Missing required field: $field"]);
        exit;
    }
}

// Get form data and sanitize
$name = trim($_POST['name']);
$email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
$mobile = trim($_POST['mobile_number']);
$password_raw = trim($_POST['password']);
$user_type = strtolower(trim($_POST['user_type']));
$created_at = date('Y-m-d H:i:s');

if (!$email) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid email address']);
    exit;
}

$password = password_hash($password_raw, PASSWORD_BCRYPT);

// Check if user already exists (by email or phone)
$check_sql = "SELECT user_id FROM users WHERE email = ? OR phone_number = ?";
$check_stmt = $conn->prepare($check_sql);
if (!$check_stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: prepare failed']);
    exit;
}
$check_stmt->bind_param("ss", $email, $mobile);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'User already exists']);
    exit;
}

// Generate unique user_id based on user_type
switch ($user_type) {
    case 'director': $prefix = '111'; break;
    case 'manager':  $prefix = '112'; break;
    case 'employee': $prefix = '113'; break;
    case 'hr':       $prefix = '114'; break;
    case 'admin':    $prefix = '115'; break;
    case 'client':   $prefix = '116'; break;
    default:         $prefix = '100'; break;
}
$suffix = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
$user_id = (int)($prefix . $suffix);

// Insert user into database
$sql = "INSERT INTO users (user_id, full_name, email, phone_number, password_hash, user_type, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: prepare failed']);
    exit;
}
$stmt->bind_param("issssss", $user_id, $name, $email, $mobile, $password, $user_type, $created_at);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'user_id' => $user_id]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Signup failed: ' . $stmt->error]);
}
?>