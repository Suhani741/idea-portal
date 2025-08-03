<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Include the database connection file
include('db_connection.php');

// Fetch the username from the session to identify the user in the database
$username = $_SESSION['username'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the new values for email and password from the form
    $new_email = $_POST['new_email'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT); // Hash the password

    // SQL query to update the user's email and password in the database
    $query = "UPDATE students SET email = ?, password = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $new_email, $new_password, $username);

    // Execute the query and check for success
    if ($stmt->execute()) {
        // If successful, redirect to the profile page and display success message
        header("Location: student_profile.php");
        exit();
    } else {
        // If an error occurs, display an error message
        echo "Error updating profile. Please try again.";
    }
}
?>
