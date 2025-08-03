<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ideamanagementportal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = trim($_POST['username_or_email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($usernameOrEmail) || empty($password)) {
        echo "Username/Email and Password are required.";
        exit();
    }

    // First, check if the user is a student
    $stmt = $conn->prepare("SELECT * FROM student WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['usn'];  // Store student USN in session
            header("Location: student_dashboard.html");  // Redirect to student dashboard
            exit();
        } else {
            echo "Invalid username/email or password.";
        }
    } else {
        $stmt = $conn->prepare("SELECT * FROM faculty WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['faculty_id'];  // Store faculty ID in session
                header("Location: faculty_dashboard.html");  // Redirect to faculty dashboard
                exit();
            } else {
                echo "Invalid username/email or password.";
            }
        } else {
            echo "Invalid username/email or password.";
        }
    }

    $stmt->close();
}

$conn->close();
?>
