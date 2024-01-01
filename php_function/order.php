<?php
include 'initdb.php';

if(isset($_GET['method'])){
    if($_GET['method'] == "cancel"){
        cancelOrder($_GET['id']);
    }
}

function allOrder() {
    $sql = "SELECT o.*, oi.quantity FROM Order o 
    INNER JOIN orderItem oi 
    ON o.order_id = oi.order_id
    WHERE o.user_id = ".$_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    return $result;
}

function cancelOrder($id) {
    $sql = "DELETE FROM Order WHERE order_id = ".$id;
    $result = mysqli_query($conn, $sql);
    return $result; 
}

?>