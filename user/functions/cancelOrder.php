<?php
include '../../php_function/initdb.php';

// Get the order ID from the POST data
$orderId = $_POST['id'];

//set status to cancelled in order table
$sql = "UPDATE cb22160.Order SET status = 'Cancelled' WHERE order_id = '$orderId'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}

// Return true if the query is successful
echo "true";

?>
