<?php
include 'initdb.php';

// Get the user ID
$userId = $_POST['id'];

// Prepare the SQL query
$query = "SELECT * FROM User WHERE user_id = '$userId'";

// Execute the query
$result = mysqli_query($conn, $query);

// Fetch the row
$row = mysqli_fetch_assoc($result);
?>