<?php

include 'initdb.php';

$status = 'false';

$sql = "SELECT a.kiosk_id FROM Kiosk a INNER JOIN Vendor v ON v.kiosk_id = a.kiosk_id WHERE v.user_id = " . $_SESSION['id'];
$result = mysqli_query($conn, $sql);

if($result){
    $menu_id = uniqid();
    $name = $_POST['addname'];
    $price = $_POST['addprice'];
    $quantity = $_POST['addquantity'];
    $menu_qr = '123456789';

    $sql = "INSERT INTO Menu (menu_id, kiosk_id, name, price, quantity_remaining, menu_qr) VALUES ('$menu_id', '$kiosk', '$name', '$price', '$quantity', '$menu_qr')";
    $result = mysqli_query($conn, $sql);

    if($result){
        $status = 'true';
    }
}
$arr = array($status);
echo json_encode($arr);

?>