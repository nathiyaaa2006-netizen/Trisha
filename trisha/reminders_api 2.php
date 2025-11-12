<?php
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// ...existing code...
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

include "dbconn.php"; // Use dbconn.php for DB connection

// GET: Fetch all reminders
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM reminders";
    $result = $conn->query($sql);

    $reminders = [];
    if ($result && $result->num_rows > 0) {
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

    $title = $_POST['title'];
    $time = $_POST['time'];
    $participants = $_POST['participants'];
    $location = $_POST['location'];

    $sql = "INSERT INTO reminders (title, time, participants, location) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["error" => "Prepare failed: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("ssss", $title, $time, $participants, $location);

    if ($stmt->execute()) {
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
    $stmt->close();
    exit;
}

http_response_code(405);
echo json_encode(["error" => "Method not allowed"]);
$conn->close();
?>