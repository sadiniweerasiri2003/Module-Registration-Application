<?php
global $conn;
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nic = $_POST['nic'];

    // Validate the NIC against the database
    $query = "SELECT * FROM users WHERE NIC='$nic'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // NIC is authenticated, display user details
            $row = mysqli_fetch_assoc($result);

            $username = $row['username'];
            $telephone = $row['telephone'];
            $course = $row['course'];
            $address = $row['address'];

            // Display user details
            echo "<h2>User Details:</h2>";
            echo "<p>NIC: $nic</p>";
            echo "<p>Username: $username</p>";
            echo "<p>Telephone: $telephone</p>";
            echo "<p>Course: $course</p>";
            echo "<p>Address: $address</p>";
        } else {
            // No matching user found
            echo "User not found. Please enter a valid NIC.";
        }
    } else {
        // Error in the query
        echo "Error in database query.";
    }
}
?>

