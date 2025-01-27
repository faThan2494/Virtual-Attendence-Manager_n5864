<?php
// Start the session
session_start();

// Destroy the session to log out the user
session_unset();
session_destroy();

// Redirect to the home page (replace 'index.html' with your actual home page file)
header("Location: index.html");
exit();
?>
