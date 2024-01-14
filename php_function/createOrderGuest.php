<?php

include 'initdb.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $inpurchase = $_POST['inpurchase'];

    if ($inpurchase) {
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
    } else {
        $name = $_POST['name'];
        $cart = $_POST['cart'];
        $totalPrice = $_POST['totalPrice'];
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

            //Update quantity menu
            //Check Quantity
            $menusql = "SELECT * FROM Menu WHERE menu_id = '$menu_id'";
            $result_menu = mysqli_query($conn, $menusql);
            while ($row = mysqli_fetch_assoc($result_menu)) {
                $current_qty = $row['quantity_remaining'];
                if ($current_qty > $quantity) {
                    $remaining_qty = $current_qty - $quantity;

                    // Update quantity
                    $upadte_sql = "UPDATE Menu SET quantity_remaining = $remaining_qty WHERE menu_id = '$menu_id'";
                    $result_updated = mysqli_query($conn, $upadte_sql);
                    if (!$result_updated) {
                        die("Error executing query: " . mysqli_error($conn));
                    }
                } else {
                    die("Not Enough Item: " . mysqli_error($conn));
                }
            }
        }
    }
    

    unset($_SESSION['cart']);
} 

?>