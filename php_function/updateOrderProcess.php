<?php
include 'initdb.php';
include 'authPage.php';

if (isset($_POST['id'])) {
    $orderId = $_POST['id'];
    $orderstatus = $_POST['status'];

    $sql = "UPDATE `Order` SET status='$orderstatus' WHERE order_id='$orderId'";
  
    $result = mysqli_query($conn, $sql);
  
    if (!$result) {
      // Handle the error
      die("Error: " . mysqli_error($conn));
    }
  
    if (mysqli_affected_rows($conn) > 0) {
      $status = 'true';
    } else {
      $status = 'false';
    }
  
    $arr = array($status);
    echo json_encode($arr);
  }

?>