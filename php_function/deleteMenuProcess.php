<?php
include 'initdb.php';
include 'authPage.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM Menu WHERE menu_id='$id'";

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