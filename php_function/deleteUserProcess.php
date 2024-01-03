<?php
include 'initdb.php';
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    //check if user is a vendor
    $sql = "SELECT * FROM Vendor WHERE user_id='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $vendor = mysqli_fetch_assoc($result);
        $vendor_id = $vendor['vendor_id'];
        $sql = "DELETE FROM Vendor WHERE vendor_id='$vendor_id'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // Handle the error
            die("Error: " . mysqli_error($conn));
        }
    }
    $sql = "DELETE FROM User WHERE user_id='$id'";

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
