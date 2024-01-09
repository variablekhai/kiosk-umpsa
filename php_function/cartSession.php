<?php
include 'initdb.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $menu_id = $_POST['menu_id'];
    $quantity = $_POST['quantity'];
    $kiosk_id = $_POST['kiosk_id'];

    // Query the menu data based on the $menu_id
    $menu_query = "SELECT * FROM Menu WHERE menu_id = '$menu_id'";
    $result_menu = mysqli_query($conn, $menu_query);

    if (!$result_menu) {
        die("Error executing query: " . mysqli_error($conn));
    }

    $menu = mysqli_fetch_assoc($result_menu);

    // Query kiosk name based on $kiosk_id
    $kiosk_query = "SELECT * FROM Kiosk WHERE kiosk_id = '$kiosk_id'";
    $result_kiosk = mysqli_query($conn, $kiosk_query);

    if (!$result_kiosk) {
        die("Error executing query: " . mysqli_error($conn));
    }

    $kiosk = mysqli_fetch_assoc($result_kiosk);

    // Assuming you have fetched the menu data from the database
    $menu_data = [
        'id' => uniqid(),
        'menu_id' => $menu['menu_id'],
        'name' => $menu['name'],
        'price' => $menu['price'],
        'quantity' => $quantity,
        'image' => $menu['image'],
        'kiosk' => $kiosk['kiosk_id'],
        // Add more properties as needed
    ];

    // Store the menu data in the cart session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $menu_data;

    echo json_encode($_SESSION['cart']);
    
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    // Remove the item from the cart session
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['id'] === $id) {
            unset($_SESSION['cart'][$index]);
        }
    }

    echo json_encode($_SESSION['cart']);
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($_SESSION['cart']);
}
    
?>