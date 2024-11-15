<?php
// Database credentials
$servername = "localhost"; // Adjust if your database server is different
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "registrationdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $staff_name = $_POST['staff_name'];
    $staff_position = $_POST['staff_position'];
    $gender = $_POST['gender'];
    $address = $_POST['staff_address'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO staff (staff_name, staff_position, gender, address) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $staff_name, $staff_position, $gender, $address);

    // Execute the query
    if ($stmt->execute()) {
        echo "New staff member added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
