<?php
// Start the session (if not already started)
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to a login or home page
header("Location: index.html"); // Change the URL as needed
exit();
?>
