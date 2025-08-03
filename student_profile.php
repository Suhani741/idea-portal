<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch student information from session
$username = $_SESSION['username'];
$email = $_SESSION['email'];

// Here you can also fetch other information from the database if needed
// For example, fetch the student's full name, department, or other profile data from a database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Profile</title>
    <link rel="stylesheet" href="student_profile.css">
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

    <!-- Profile Information -->
    <section id="profile-info">
        <h2>Your Profile</h2>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>

        <!-- Add more profile fields if necessary, such as department or student number -->
        
        <!-- Example for adding additional profile information -->
        <!--
        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($full_name); ?></p>
        <p><strong>Department:</strong> <?php echo htmlspecialchars($department); ?></p>
        -->

        <h3>Update Profile Information</h3>
        <form action="update_profile.php" method="POST">
            <label for="new_email">New Email:</label>
            <input type="email" id="new_email" name="new_email" placeholder="Enter new email" required>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>

            <button type="submit">Update Profile</button>
        </form>
    </section>

    <script src="student_profile.js"></script>
</body>
</html>
