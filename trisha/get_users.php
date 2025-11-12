<?php
require 'db.php';

$stmt = $pdo->query("SELECT id, name, role, email, profile_visibility, contact_information, portfolio_access FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($users);
?>
