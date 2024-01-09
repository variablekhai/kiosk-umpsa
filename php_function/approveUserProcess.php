<?php

include 'initdb.php';
session_start();

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $kiosk = $_POST['kioskId'];

  $sql = "UPDATE Vendor SET status='Approved', kiosk_id=$kiosk WHERE user_id='$id'";

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

  echo $status;
}

?>