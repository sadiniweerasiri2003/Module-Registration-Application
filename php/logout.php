<?php
session_start(); // Start the session to access session variables
session_destroy(); // Destroy all session data

// Redirect to the login page
header("Location: ../html/login.html");
exit();
?>
