<?php
// Start or resume session
session_start();

global $conn;
include "config.php";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../html/login.html"); // Redirect to login page if not logged in
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nic = $_POST['nic'];

    // Validate the NIC against the database
    $query = "SELECT * FROM marks WHERE nic='$nic'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // NIC is authenticated, results will be given
            $row = mysqli_fetch_assoc($result);
            $marks = $row['marks'];

            // Display marks or "Absent" if no marks are found
            if ($marks > 0) {
                echo "Student Marks: $marks";
            } else {
                echo "Absent";
            }
        } else {
            // Invalid NIC, display an error message
            $error_message = "You have not taken the exam";
            echo $error_message;
        }
    } else {
        // Error in the query
        $error_message = "Error in database query.";
        echo $error_message;
    }
}
?>
