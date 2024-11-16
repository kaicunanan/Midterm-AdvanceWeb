<?php
session_start(); // Start session to destroy it

session_destroy(); // Destroy the session to log out the user

// Block caching of the page to prevent the user from going back to the dashboard
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache");

// Redirect to login page
header("Location: index.php");
exit;

?>