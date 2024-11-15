<?php
session_start();
session_destroy();
header("location: login.html"); // Redirect to login page after logout
?>
