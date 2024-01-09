<?php

include 'initdb.php';
include 'authPage.php';

$status = 'false';

$menu_id = uniqid();
$kiosk = $_SESSION['kiosk_id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$menu_qr = '123456789';
$date = date("Y-m-d H:i:s");

$sql = "INSERT INTO Menu VALUES ('$menu_id', '$kiosk', '$name', $price, '$description', '$quantity', '$menu_qr', '$date')";

if(mysqli_query($conn, $sql)){
    $status = 'true';
}

echo $status;

?>