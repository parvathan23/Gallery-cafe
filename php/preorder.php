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
    $full_name = mysqli_real_escape_string($conn, $_POST['full-name']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $food_title = "Chicke Hawain Pizza"; // Hardcoded for demo; replace with dynamic value if needed
    $quantity = (int)$_POST['qty'];
    $total_price = 220 * $quantity; // Calculate total price (assuming fixed price of $220)

    // Insert into database
    $sql = "INSERT INTO orders (full_name, phone_number, email, address, food_title, quantity, total_price)
            VALUES ('$full_name', '$phone_number', '$email', '$address', '$food_title', $quantity, $total_price)";

    if ($conn->query($sql) === TRUE) {
        echo "Order placed successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
