<?php
include 'initdb.php';
session_start();

if (isset($_POST['name']) && isset($_POST['password'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $password = $_POST['password'];
  $image = $_POST['image'];

  $sql = "UPDATE User SET name='$name', password='$password', image='$image' WHERE user_id='$id'";

  $result = mysqli_query($conn, $sql);

  if (!$result) {
    // Handle the error
    die("Error: " . mysqli_error($conn));
  }

  if (mysqli_affected_rows($conn) > 0) {
    $status = 'true';
    
    if (strpos($_SERVER['HTTP_REFERER'], 'user-management.php') !== false) {
      $_SESSION['name'] = $name;
      $_SESSION['password'] = $password;
      $_SESSION['image'] = $image;
    }
    
  } else {
    $status = 'false';
  }

  $arr = array($status, $name, $password, $image);
  echo json_encode($arr);
}


?>