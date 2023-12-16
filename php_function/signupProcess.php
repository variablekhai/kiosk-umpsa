<?php
include 'initdb.php';
if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["name"])) {
    $status = 'true';
    $email = $_POST["email"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $type = $_POST["type"];
    $sql = "SELECT * FROM User WHERE username='$email' AND password='$password' AND user_type = '$type'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $status = 'false';
    }
    else {
        $unID = uniqid();
        $now = date('Y-m-d H:i:s');
        $sql = "INSERT INTO User VALUES ('$unID', '$name', '$email', '$password', '$now')";
        if (mysqli_query($conn, $sql)) {
            $status = 'true';
        } 
        else {
            $status = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    echo $status;
}
    
?>