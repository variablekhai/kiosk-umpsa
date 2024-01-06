<?php
include 'initdb.php';

// Get the user ID
$menuId = $_POST['id'];

// Prepare the SQL query
$query = "SELECT * FROM Menu WHERE menu_id = '$menuId'";

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
