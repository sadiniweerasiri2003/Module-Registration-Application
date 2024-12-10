<?php
global $conn;
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $nic = $_POST['nic'];
    $username = $_POST['username'];
    $telephone=$_POST['telephone'];
    $course=$_POST['course'];
    $address=$_POST['address'];

    // Insert into the table
    $query = "INSERT INTO users (NIC,username,telephone,course,address) VALUES ('$nic', '$username','$telephone','$course','$address')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $message = "sign up successfully";
    } else {
        $message = "Failed to sign up.please try again using another username";
    }

    // Display the result message and link to login page
    echo '<html>
            <body>
                <p>' . $message . '</p>
                <a href="../html/login.html">Login now</a>
            </body>
          </html>';
} else {
    echo "Invalid request";
}
?>

