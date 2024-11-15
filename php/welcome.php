<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location: login.html"); // Redirect to login page if not logged in
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
