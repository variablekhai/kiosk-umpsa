<?php
include 'initdb.php';

// Get the user ID
$orderId = $_POST['id'];

// Prepare the SQL query
$query = "SELECT oi.*, o.status FROM OrderItem oi INNER JOIN `Order` o ON oi.order_id = o.order_id WHERE id = '$orderId'";

// Execute the query
$result = mysqli_query($conn, $query);

// Fetch the row
$row = mysqli_fetch_assoc($result);

// Convert the row to JSON
$json = json_encode($row);

// Return the JSON response
header('Content-Type: application/json');
echo $json;
?>