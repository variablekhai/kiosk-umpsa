<?php
include 'initdb.php';

// Get the user ID
$orderId = $_POST['id'];

// Prepare the SQL query
$query = "SELECT * FROM `Order` WHERE order_id = '$orderId'";

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