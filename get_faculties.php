<?php
include 'db.php';

if (isset($_GET['domain'])) {
    $domain = $_GET['domain'];

    // Fetch faculty members by domain
    $query = "SELECT faculty_id, username FROM faculty WHERE domain_name = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $domain);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $faculties = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $faculties[] = $row;
    }

    // Return the faculties as JSON
    echo json_encode($faculties);
}
?>
