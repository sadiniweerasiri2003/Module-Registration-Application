<?php
session_start(); // Start the session to persist user data

global $conn;
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $nic = $_POST['nic'];

    // Validate the user against the database
    $query = "SELECT * FROM users WHERE username='$username' AND nic='$nic'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Set session variable for logged-in user
        $_SESSION['username'] = $username;

        // Redirect to the user profile page (change the location as needed)
        header("Location:../html/home.html");
        exit();
    } else {
        // Invalid credentials, display an error message
        $error_message = "Invalid username or password";
        echo $error_message;
    }
}
?>
