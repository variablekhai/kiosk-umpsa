<?php
include 'initdb.php';
include 'authPage.php';

if (isset($_POST['name'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];
  
    $sql = "UPDATE Menu SET name='$name', description='$description', price=$price, quantity_remaining='$quantity', image='$image' WHERE menu_id='$id' ";
  
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