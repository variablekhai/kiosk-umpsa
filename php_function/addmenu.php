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

$sql = "INSERT INTO Menu VALUES ('$menu_id', '$kiosk', '$name', $price, '$description', '$quantity', '$menu_qr')";

if(mysqli_query($conn, $sql)){
    $status = 'true';
}

$arr = array($status);
echo json_encode($arr);

?>