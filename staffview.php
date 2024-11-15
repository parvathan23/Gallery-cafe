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

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM staff WHERE id = $delete_id";
    
    if ($conn->query($delete_sql) === TRUE) {
        echo "<p>Record deleted successfully.</p>";
        // Redirect to the same page to avoid re-submission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<p>Error deleting record: " . $conn->error . "</p>";
    }
}

// Retrieve data from the staff table
$sql = "SELECT id, staff_name, staff_position, gender, address FROM staff";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Members</title>
    <link rel="stylesheet" href="styles.css"> <!-- Ensure this path is correct -->
</head>
<body>
    <h1>Staff Members</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Action</th> <!-- Add an extra column for actions -->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['staff_name']}</td>
                        <td>{$row['staff_position']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['address']}</td>
                        <td><a href='?delete_id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a></td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found.</td></tr>";
            }
            // Close connection
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
