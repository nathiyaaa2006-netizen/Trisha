<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

include "dbdir.php";

// GET: Fetch all notifications
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM notifications ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $notifications = [];

    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }

    echo json_encode($notifications);
    exit;
}

// POST: Add new notification (using form-data)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';

    if (empty($title) || empty($description)) {
        http_response_code(400);
        echo json_encode(["error" => "Title and Description required."]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO notifications (title, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $description);
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "id" => $stmt->insert_id]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to add notification"]);
    }
    $stmt->close();
}
?>
