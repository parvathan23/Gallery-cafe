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
    $delete_sql = "DELETE FROM orders WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $stmt->close();
}

// Fetch orders
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-order View</title>
    <link rel="stylesheet" href="styles.css"> <!-- Make sure to link your stylesheet -->
</head>
<body>
    <h1>Pre-order View</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Food Title</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Order Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['full_name']}</td>
                            <td>{$row['phone_number']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['food_title']}</td>
                            <td>{$row['quantity']}</td>
                            <td>{$row['total_price']}</td>
                            <td>{$row['order_date']}</td>
                            <td>
                                <form method='get' action=''>
                                    <input type='hidden' name='delete_id' value='{$row['id']}'>
                                    <button type='submit' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No orders found</td></tr>";
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
