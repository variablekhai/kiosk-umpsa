<?php

include 'initdb.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $cart = $_POST['cart'];
    $totalPrice = $_POST['totalPrice'];
    $user_id = $_SESSION['id'];
    $payment_type = $_POST['paymentType'];

    // Insert each item in the cart into the inpurchaseorder table
    foreach ($cart as $item) {
        $menu_id = $item['menu_id'];
        $quantity = $item['quantity'];
        $total = $quantity * $item['price'];
        $kiosk_id = $item['kiosk'];
        $id = uniqid();

        $query = "INSERT INTO InPurchaseOrder (order_id, user_id, kiosk_id, menu_id, quantity, total, date_created) VALUES ('$id', '$user_id', '$kiosk_id', '$menu_id', '$quantity', '$total', NOW())";
        mysqli_query($conn, $query);
    }

    unset($_SESSION['cart']);
} 

?>