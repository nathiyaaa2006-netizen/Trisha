<?php
header("Content-Type: application/json");

// DB connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WorkCluster";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "DB Connection failed: " . $conn->connect_error]));
}

// Fetch Team Tasks
$teamTasksQuery = "SELECT quarter, team, task_count FROM team_tasks";
$teamTasksResult = $conn->query($teamTasksQuery);
$teamTasks = [];
if ($teamTasksResult->num_rows > 0) {
    while ($row = $teamTasksResult->fetch_assoc()) {
        $teamTasks[] = $row;
    }
}

// Fetch Project Status
$projectStatusQuery = "SELECT status, percentage FROM project_status";
$projectStatusResult = $conn->query($projectStatusQuery);
$projectStatus = [];
if ($projectStatusResult->num_rows > 0) {
    while ($row = $projectStatusResult->fetch_assoc()) {
        $projectStatus[] = $row;
    }
}

// Fetch Recent Documents
$documentsQuery = "SELECT document_name, size, date_uploaded, icon FROM recent_documents";
$documentsResult = $conn->query($documentsQuery);
$recentDocuments = [];
if ($documentsResult->num_rows > 0) {
    while ($row = $documentsResult->fetch_assoc()) {
        $recentDocuments[] = $row;
    }
}

// Send Response
$response = [
    "success" => true,
    "teamTasks" => $teamTasks,
    "projectStatus" => $projectStatus,
    "recentDocuments" => $recentDocuments
];

echo json_encode($response);
$conn->close();
?>
