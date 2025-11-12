    <?php
    include 'dbconn.php';

    $team_name = $_POST['team_name'];
    $team_size = $_POST['team_size'];
    $assigned_count = $_POST['assigned_count'];
    $total_projects = $_POST['total_projects'];
    $ongoing_projects = $_POST['ongoing_projects'];
    $team_id = rand(100, 999); 

    $sql = "INSERT INTO teams (team_name, team_size, assigned_count, total_projects, ongoing_projects, team_id)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siiiii", $team_name, $team_size, $assigned_count, $total_projects, $ongoing_projects, $team_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'team_id' => $team_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Insertion failed']);
    }
    ?>
