<?php
session_start(); // Resume the current session

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header("Location: index.php?page=login");
exit();
?>
