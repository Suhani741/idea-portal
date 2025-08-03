<?php
include('db_connection.php');

if (isset($_GET['domain'])) {
    $domain = $_GET['domain'];
    $query = "SELECT faculty_id, faculty_name FROM faculty WHERE domain_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $domain);
    $stmt->execute();
    $result = $stmt->get_result();

    $facultyList = [];
    while ($row = $result->fetch_assoc()) {
        $facultyList[] = $row;
    }

    echo json_encode($facultyList);
}
?>
