<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

include "dbdir.php";

// GET: Fetch all projects
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM projects ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $projects = [];

    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }

    echo json_encode($projects);
    exit;
}

// POST: Add new project (using form-data)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $progress = $_POST['progress'] ?? 0;

    if (empty($title) || empty($description)) {
        http_response_code(400);
        echo json_encode(["error" => "Title and Description required."]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO projects (title, description, progress) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $description, $progress);
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "id" => $stmt->insert_id]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to add project"]);
    }
    $stmt->close();
}
?>
