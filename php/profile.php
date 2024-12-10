<?php
global $conn;
session_start(); // Start the session to persist user data
include "config.php";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if user not found
    header("Location: ../html/login.html");
    exit();

}

// Fetch user details from the database
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $userDetails = mysqli_fetch_assoc($result);
} else {
    // Redirect to login page if user not found
    header("Location: ../html/login.html");
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/hr.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
<div class="navbar">
    <a href="../html/home.html">Home</a>
    <a href="../html/exam.html">Exam</a>
    <a href="../html/results.html">Results</a>
    <a href="../html/search.html">Students</a>
    <div class="profile">
        <a href="../php/profile.php">Profile</a>
    </div>
</div>
<div class="container">
    <h1>User Profile</h1>
    
    <p>Welcome, <?php echo $userDetails['username']; ?>!</p>

    <ul>
        <li>NIC: <?php echo $userDetails['NIC']; ?></li>
        <li>Username: <?php echo $userDetails['username']; ?></li>
        <li>Telephone: <?php echo $userDetails['telephone']; ?></li>
        <li>Course: <?php echo $userDetails['course']; ?></li>
        <li>Address: <?php echo $userDetails['address']; ?></li>
    </ul>

    <!-- Add other profile details as needed -->

    <a class="button" href="../html/beforehome.html">Logout</a>
    <a class="button" href="update.php">Update Profile</a>
    <a class="button" href="../html/beforehome.html">Delete Account</a>
</div>
</body>
</html>
