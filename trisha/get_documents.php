<?php
include 'db.php';

$sql = "SELECT * FROM documents ORDER BY date_uploaded DESC LIMIT 10";
$result = $conn->query($sql);

$documents = [];

while ($row = $result->fetch_assoc()) {
    $documents[] = $row;
}

echo json_encode($documents);
?>
 