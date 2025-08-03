<?php
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
    // Retrieve and validate input
    $role = $_POST['role'] ?? '';
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    if ($role === 'student') {
        $usn = trim($_POST['usn'] ?? '');
        $year = intval($_POST['year'] ?? 0);
        $branch = trim($_POST['branch'] ?? '');

        if (empty($usn) || empty($username) || empty($year) || empty($branch) || empty($email) || empty($password)) {
            die("All student fields are required.");
        }

        // Check if the student already exists
        $stmt = $conn->prepare("SELECT * FROM student WHERE usn = ? OR email = ?");
        $stmt->bind_param("ss", $usn, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            die("User with this USN or Email already exists.");
        }

        // Insert student into the database
        $stmt = $conn->prepare("INSERT INTO student (usn, username, year, branch, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss", $usn, $username, $year, $branch, $email, $passwordHash);

    } elseif ($role === 'faculty') {
        $faculty_id = trim($_POST['faculty_id'] ?? '');
        $department = trim($_POST['department'] ?? '');
        $domain = trim($_POST['domain'] ?? '');

        if (empty($faculty_id) || empty($username) || empty($department) || empty($domain) || empty($email) || empty($password)) {
            die("All faculty fields are required.");
        }

        // Check if the faculty already exists
        $stmt = $conn->prepare("SELECT * FROM faculty WHERE faculty_id = ? OR email = ?");
        $stmt->bind_param("ss", $faculty_id, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            die("User with this Faculty ID or Email already exists.");
        }

        // Insert faculty into the database
        $stmt = $conn->prepare("INSERT INTO faculty (faculty_id, username, department, domain, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $faculty_id, $username, $department, $domain, $email, $passwordHash);

    } else {
        die("Invalid role selected.");
    }

    // Execute the query
    if ($stmt->execute()) {
        header("Location: login.html");  // Redirect to login page after successful signup
        exit();
    } else {
        error_log("Error: " . $stmt->error);
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
