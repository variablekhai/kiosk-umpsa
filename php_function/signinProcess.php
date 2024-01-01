<?php
include 'initdb.php';
if(isset($_POST['email']) && isset($_POST['password'])) {
    $status = 'false';
    $type = '';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM User WHERE username='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION["password"] = $password;
        $_SESSION["name"] = $row["name"];
        $_SESSION["type"] = $row["user_type"];
        $type = $row["user_type"];
        $_SESSION["image"] = $row["image"];
        $status = 'true';
    }
    $arr = array($status, $type);
    echo json_encode($arr);
}
?>