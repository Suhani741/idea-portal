<?php
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch student information (this is just an example, you can customize it)
$username = $_SESSION['username'];
$email = $_SESSION['email'];

// You can also add logic to fetch any dashboard-specific data, like pending idea submissions.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="student_dashboard.css">
</head>
<body>
    <!-- Header -->
    <header>
        <img src="MITE_Logo.jpg" alt="College Logo">
        <div class="portal">IDEA MANAGEMENT PORTAL</div>
    </header>

    <!-- Menu -->
    <nav class="menu">
        <a href="student_dashboard.html">Home</a>
        <a href="student_home.html">Submit the Idea</a>
        <a href="student_profile.php">View Profile</a>
        <a href="logout.php">Logout</a>
    </nav>

    <!-- Dashboard Content -->
    <div id="dashboard-content">
        <h2>Welcome to your Dashboard</h2>
        <p>Hello, <?php echo htmlspecialchars($username); ?>!</p>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
        <p>Manage your ideas, view your profile, and submit new ideas.</p>
    </div>

    <script src="student_dashboard.js"></script>
</body>
</html>
