<?php
include 'dbconn.php';

$sql = "SELECT s_no, team_id, project_id, user_id, role, added_at FROM project_members";
$result = $conn->query($sql);

$members = [];
while ($row = $result->fetch_assoc()) {
    $members[] = $row;
}

echo json_encode($members);
?>
