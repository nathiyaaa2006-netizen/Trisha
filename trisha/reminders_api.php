<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

include "db.php";

// GET: Fetch all reminders
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM reminders";
    $result = $conn->query($sql);

    $reminders = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reminders[] = $row;
        }
    }

    echo json_encode($reminders);
    exit;
}

// POST: Add new reminder (form-data)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['title'], $_POST['time'], $_POST['participants'], $_POST['location'])) {
        http_response_code(400);
        echo json_encode(["error" => "Missing fields"]);
        exit;
    }

    $title = $conn->real_escape_string($_POST['title']);
    $time = $conn->real_escape_string($_POST['time']);
    $participants = $conn->real_escape_string($_POST['participants']);
    $location = $conn->real_escape_string($_POST['location']);

    $sql = "INSERT INTO reminders (title, time, participants, location)
            VALUES ('$title', '$time', '$participants', '$location')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            "id" => $conn->insert_id,
            "title" => $title,
            "time" => $time,
            "participants" => $participants,
            "location" => $location
        ]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to add reminder"]);
    }
    exit;
}

http_response_code(405);
echo json_encode(["error" => "Method not allowed"]);
?>
