<?php

function toggleMenu($menu_id) {
    // Check if menu id exists in inpurchasemenu table
    $menu_exists = checkMenuExists($menu_id);

    if ($menu_exists) {
        // Remove menu from inpurchasemenu table
        removeMenu($menu_id);
        echo "removed";
    } else {
        // Add menu to inpurchasemenu table
        addMenu($menu_id);
        echo "added";
    }
}

function checkMenuExists($menu_id) {
    $check_query = "SELECT * FROM InPurchaseMenu WHERE menu_id = '" . $menu_id . "'";
    include '../../php_function/initdb.php';
    $check_result = mysqli_query($conn, $check_query);
    if ($check_result) {
        if (mysqli_num_rows($check_result) > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

function removeMenu($menu_id) {
    $remove_query = "DELETE FROM InPurchaseMenu WHERE menu_id = '" . $menu_id . "'";
    include '../../php_function/initdb.php';
    $remove_result = mysqli_query($conn, $remove_query);
    if ($remove_result) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

function addMenu($menu_id) {
    $item_id = uniqid();
    $add_query = "INSERT INTO InPurchaseMenu (item_id, menu_id) VALUES ('$item_id', '$menu_id')";
    include '../../php_function/initdb.php';
    $add_result = mysqli_query($conn, $add_query);
    if ($add_result) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


$menu_id = $_POST['menu_id'];
toggleMenu($menu_id);

?>