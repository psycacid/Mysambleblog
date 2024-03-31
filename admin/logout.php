<?php
// Start session
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // If logged in, destroy the session
    session_destroy();
}

// Redirect to the index.php page
header("Location: ../index.php");
exit();
?>
