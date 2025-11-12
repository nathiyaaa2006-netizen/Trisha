<?php
include 'dbconn.php';

$users = [
    ['user_id' => 'admin@example.com',   'user_type' => 'Admin',    'password' => 'admin123'],
    ['user_id' => 'director@example.com','user_type' => 'Director', 'password' => 'director123'],
    ['user_id' => 'manager@example.com', 'user_type' => 'Manager',  'password' => 'manager123'],
    ['user_id' => 'hr@example.com',      'user_type' => 'HR',       'password' => 'hr123'],
    ['user_id' => 'client@example.com',  'user_type' => 'Client',   'password' => 'client123'],
    ['user_id' => 'employee@example.com','user_type' => 'Employee', 'password' => 'employee123'],
];

foreach ($users as $user) {
    $password_hash = password_hash($user['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (user_id, user_type, password_hash) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $user['user_id'], $user['user_type'], $password_hash);
    if ($stmt->execute()) {
        echo "✅ User '{$user['user_id']}' added successfully.<br>";
    } else {
        echo "❌ Error adding user '{$user['user_id']}': " . $stmt->error . "<br>";
    }
}

$conn->close();
?>
