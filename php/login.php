<?php
session_start();

// Database connection parameters
$servername = "localhost"; // Change this if your database server is on a different host
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "registrationdb"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user credentials
    $sql = "SELECT * FROM users WHERE email='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['email'];
            
            // Redirect to dashboard or any other authenticated page
            header("Location: dashboard.php");
            exit();
        } else {
            // Incorrect password
            echo "Incorrect password. Please try again.";
        }
    } else {
        // User not found
        echo "User not found. Please check your email and try again or <a href='Register.html'>create an account</a>.";
    }
}

// Close database connection
$conn->close();
?>
