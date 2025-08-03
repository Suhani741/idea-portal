<?php
// Start session and connect to the database
session_start();
include('db_connection.php'); // Include the database connection file

// Fetch registered students for team leader and members
$studentsQuery = "SELECT usn, username FROM Student";
$studentsResult = $conn->query($studentsQuery);

// Fetch domains and associated faculty
$domainsQuery = "SELECT domain_name FROM domain";
$domainsResult = $conn->query($domainsQuery);

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $team_leader = $_POST['team_leader'];
    $team_member1 = $_POST['team_member1'] ?? null;
    $team_member2 = $_POST['team_member2'] ?? null;
    $team_member3 = $_POST['team_member3'] ?? null;
    $domain = $_POST['domain'];
    $faculty = $_POST['faculty'];
    $abstract = $_POST['abstract'];

    // Validate required fields
    if (empty($title) || empty($team_leader) || empty($domain) || empty($faculty) || empty($abstract)) {
        echo "All required fields must be filled!";
        exit;
    }

    // Step 1: Insert the team data into the team table
    $sql_team = "INSERT INTO team (team_leader, team_member1, team_member2, team_member3, domain_name) 
                 VALUES (?, ?, ?, ?, ?)";
    
    $stmt_team = $conn->prepare($sql_team);
    $stmt_team->bind_param("sssss", $team_leader, $team_member1, $team_member2, $team_member3, $domain);

    if ($stmt_team->execute()) {
        // Step 2: Get the team ID (last inserted team ID)
        $team_id = $stmt_team->insert_id;

        // Step 3: Insert the idea into the submit_idea table
        $sql_idea = "INSERT INTO submit_idea (idea_title, team_id, idea_description, faculty_id) 
                     VALUES (?, ?, ?, ?)";
        
        $stmt_idea = $conn->prepare($sql_idea);
        $stmt_idea->bind_param("ssss", $title, $team_id, $abstract, $faculty);

        if ($stmt_idea->execute()) {
            echo "Idea submitted successfully!";
            // Redirect back to the student dashboard
            header("Location: student_dashboard.html");
            exit;
        } else {
            echo "Error submitting idea: " . $stmt_idea->error;
        }
    } else {
        echo "Error creating team: " . $stmt_team->error;
    }
}
?>
