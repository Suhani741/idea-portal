<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ideamanagementportal";  // Updated database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teamID = $_POST['teamID']; // Assuming teamID is being passed from the form
    $abstract = $_POST['abstract'];

    $sql = "INSERT INTO ideas (TeamID, Abstract) VALUES ('$teamID', '$abstract')";

    if ($conn->query($sql) === TRUE) {
        echo "Idea submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
