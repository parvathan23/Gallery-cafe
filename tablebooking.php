<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
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
    $delete_sql = "DELETE FROM booking WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo "<p>Record deleted successfully.</p>";
    } else {
        echo "<p>Error deleting record: " . $conn->error . "</p>";
    }
    $stmt->close();
}

// Fetch table bookings
$sql = "SELECT * FROM booking ORDER BY check_in DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Booking View</title>
    <link rel="stylesheet" href="styles.css"> <!-- Ensure this path is correct -->
</head>
<body>
    <h1>Table Booking View</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Table Number</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Adults</th>
                <th>Children</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone_number']}</td>
                            <td>{$row['table_number']}</td>
                            <td>{$row['check_in']}</td>
                            <td>{$row['check_out']}</td>
                            <td>{$row['adults']}</td>
                            <td>{$row['childs']}</td>
                            <td>
                                <form method='get' action=''>
                                    <input type='hidden' name='delete_id' value='{$row['id']}'>
                                    <button type='submit' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No bookings found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
