<?php
global $conn;
include "config.php";

session_start(); // Start the session to persist user data

if (!isset($_SESSION['username'])) {
    header("Location: ../html/login.html"); // Redirect to login page if not logged in
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newNIC = $_POST['newNIC'];
    $newUsername = $_POST['newUsername'];
    $newTelephone = $_POST['newTelephone'];
    $newCourse = $_POST['newCourse'];
    $newAddress = $_POST['newAddress'];

    // Check if the provided NIC exists
    $checkQuery = "SELECT * FROM users WHERE NIC='$newNIC'";

    $checkResult = mysqli_query($conn, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        // Update user details in the database based on NIC
        $updateQuery = "UPDATE users SET username=?, telephone=?, course=?, address=? WHERE NIC=?";
        $stmt = mysqli_prepare($conn, $updateQuery);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sssss", $newUsername, $newTelephone, $newCourse, $newAddress, $newNIC);

        // Execute the update
        $updateResult = mysqli_stmt_execute($stmt);

        // Close the statement
        mysqli_stmt_close($stmt);

        if ($updateResult) {
            // Write and close the session before redirecting
            session_write_close();

            // Redirect to the profile page after successful update
            header("Location:profile.php");
            exit();
        } else {
            // Handle update error
            echo "Error updating profile. Please try again.";
        }
    } else {
        // Handle NIC not found
        echo "NIC not found in the database.";
    }
}

mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/update.css">
</head>
<body>
<h1>Edit Profile</h1>

<form action="update.php" method="POST">
    <!-- Input fields for updated details -->
    <label for="newNIC">enter current NIC:</label>
    <input type="text" name="newNIC" required>

    <label for="newUsername">New Username:</label>
    <input type="text" name="newUsername" required>

    <label for="newTelephone">New Telephone:</label>
    <input type="text" name="newTelephone" required>

    <label for="newCourse">New Course:</label>
    <input type="text" name="newCourse" required>

    <label for="newAddress">New Address:</label>
    <input type="text" name="newAddress" required>

    <input type="submit" value="Update Profile">
</form>

<!-- ... (existing code) -->
</body>
</html>
