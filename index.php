<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

echo "Welcome, " . $_SESSION['user_id'];  // Display the user ID or username (depending on your design)
?>
