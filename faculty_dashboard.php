<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'idea_management'); // Replace with your DB credentials

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Team Details
function fetchTeamDetails() {
    global $conn;
    $sql = "SELECT team_id, team_leader_usn, team_member1_usn, team_member2_usn, team_member3_usn FROM team";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['team_id'] . "</td>
                    <td>" . $row['team_leader_usn'] . "</td>
                    <td>" . ($row['team_member1_usn'] ? $row['team_member1_usn'] : 'N/A') . "</td>
                    <td>" . ($row['team_member2_usn'] ? $row['team_member2_usn'] : 'N/A') . "</td>
                    <td>" . ($row['team_member3_usn'] ? $row['team_member3_usn'] : 'N/A') . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No team data available.</td></tr>";
    }
}

// Fetch Domain Details
function fetchDomainDetails() {
    global $conn;
    $sql = "SELECT domain_name, faculty_name FROM domain";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['domain_name'] . "</td>
                    <td>" . $row['faculty_name'] . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No domain data available.</td></tr>";
    }
}

// Fetch Idea Submissions
function fetchIdeaSubmissions() {
    global $conn;
    $sql = "SELECT idea_id, idea_title, idea_description FROM submit_idea";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['idea_title'] . "</td>
                    <td>" . $row['idea_description'] . "</td>
                    <td><button onclick='toggleFeedbackForm(" . $row['idea_id'] . ")'>Provide Feedback</button></td>
                  </tr>
                  <tr id='feedback-form-" . $row['idea_id'] . "' style='display:none;'>
                    <td colspan='3'>
                        <textarea id='feedback-text-" . $row['idea_id'] . "' placeholder='Enter feedback'></textarea><br>
                        <button onclick='submitFeedback(" . $row['idea_id'] . ")'>Send Feedback</button>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No idea submissions available.</td></tr>";
    }
}

$conn->close();
?>
