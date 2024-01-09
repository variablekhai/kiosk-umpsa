<?php

include 'initdb.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $points = $_POST['points'];
    $cart = $_POST['cart'];
    $totalPrice = $_POST['totalPrice'];
    $totalPointsEarned = $_POST['totalPointsEarned'];
    $totalPointsUsed = $_POST['totalPointsUsed'];
    $membership_id = $_POST['membership_id'];
    $user_id = $_SESSION['id'];
    $payment_type = $_POST['paymentType'];

    // Query the menu data based on the $menu_id
    $order_id = uniqid();
    $order_query = "INSERT INTO `Order` (`order_id`, `user_id`, `name`, `total`, `status`, `date_created`) VALUES ('$order_id', '$user_id', '$name', '$totalPrice', 'Ordered', CURRENT_TIMESTAMP)";
    $result_order = mysqli_query($conn, $order_query);

    if (!$result_order) {
        die("Error executing query: " . mysqli_error($conn));
    }

    // Query payment
    $payment_id = uniqid();
    $payment_query = "INSERT INTO `Payment` (`payment_id`, `order_id`, `amount`, `payment_type`) VALUES ('$payment_id', '$order_id', $totalPrice, '$payment_type')";
    $result_payment = mysqli_query($conn, $payment_query);

    if (!$result_payment) {
        die("Error executing query: " . mysqli_error($conn));
    }

    // Query membership
    $membership_query = "SELECT * FROM Membership WHERE membership_id = '$membership_id'";
    $result_membership = mysqli_query($conn, $membership_query);

    if (!$result_membership) {
        die("Error executing query: " . mysqli_error($conn));
    }

    $membership = mysqli_fetch_assoc($result_membership);
    $new_points = $membership['membership_point'] + $totalPointsEarned - $totalPointsUsed;
    $membership_update_query = "UPDATE `Membership` SET `membership_point` = $new_points WHERE `membership_id` = '$membership_id'";
    $result_membership_update = mysqli_query($conn, $membership_update_query);
    if (!$result_membership_update) {
        die("Error executing query: " . mysqli_error($conn));
    }
    

    // Execute order items
    foreach ($cart as $item) {
        $menu_id = $item['menu_id'];
        $quantity = $item['quantity'];
        $kiosk_id = $item['kiosk'];
        $id = uniqid();

        $order_item_query = "INSERT INTO `OrderItem` (`id`, `order_id`, `menu_id`, `kiosk_id`, `quantity`) VALUES ('$id', '$order_id', '$menu_id', '$kiosk_id', '$quantity')";
        $result_order_item = mysqli_query($conn, $order_item_query);

        if (!$result_order_item) {
            die("Error executing query: " . mysqli_error($conn));
        }
    }

    unset($_SESSION['cart']);
    echo json_encode($order_id);
} 

// else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
//     $id = $_GET['id'];
//     // Remove the item from the cart session
//     foreach ($_SESSION['cart'] as $index => $item) {
//         if ($item['id'] === $id) {
//             unset($_SESSION['cart'][$index]);
//         }
//     }
// }

?>