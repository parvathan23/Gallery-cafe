<?php
// Database connection details
$servername = "localhost"; // Replace with your MySQL host
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "registrationdb"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['number']);
    $table_number = (int)$_POST['Table'];
    $check_in = mysqli_real_escape_string($conn, $_POST['check_in']);
    $adults = (int)$_POST['adults'];
    $childs = (int)$_POST['childs'];

    // Insert into database
    $sql = "INSERT INTO booking (name, email, phone_number, table_number, check_in, check_out, adults, childs)
            VALUES ('$name', '$email', '$phone_number', $table_number, '$check_in', '$check_out', $adults, $childs)";

    if ($conn->query($sql) === TRUE) {
        echo "Booking made successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
