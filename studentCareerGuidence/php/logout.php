<?php
session_start();
session_destroy(); // Clears all session data
header("Location: ../index.html"); // Redirects to home page
exit();
?>