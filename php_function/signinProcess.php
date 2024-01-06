<?php
include 'initdb.php';
if(isset($_POST['email']) && isset($_POST['password'])) {
    $status = 'false';
    $type = '';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT u.*, v.kiosk_id FROM User u LEFT JOIN Vendor v ON u.user_id = v.user_id WHERE username='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        session_start();
        
        $_SESSION['id'] = $row["user_id"];
        $_SESSION['email'] = $email;
        $_SESSION["password"] = $password;
        $_SESSION["name"] = $row["name"];
        $_SESSION["type"] = $row["user_type"];
        if($row["user_type"] == 'Vendor'){
            $_SESSION['kiosk_id'] = $row["kiosk_id"];
        }
        $type = $row["user_type"];
        $_SESSION["image"] = $row["image"];
        $status = 'true';
    }
    $arr = array($status, $type);
    echo json_encode($arr);
}
?>