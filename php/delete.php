<?php
// Start or resume session
session_start();

global $conn;
include "config.php";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location:../html/login.html");
    exit();
}

// Get username from the session
$username = $_SESSION['username'];

// Delete user details from the database
$query = "UPDATE users SET NIC='', username='', telephone='', course='', address='' WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Details deleted successfully, redirect to beforehome.html
    header("Location: ../html/beforehome.html");
    exit();
} else {
    // Error in the query
    $error_message = "Error deleting details: " . mysqli_error($conn);
    echo $error_message;
}
?>
