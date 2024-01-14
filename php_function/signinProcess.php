<?php
include 'initdb.php';
if(isset($_POST['email']) && isset($_POST['password'])) {
    $status = 'false';
    $type = '';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT u.*, v.kiosk_id, v.status FROM User u LEFT JOIN Vendor v ON u.user_id = v.user_id WHERE username='$email' AND password='$password'";
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
        if($row["status"] == 'Pending') {
            $status = 'Pending';
        }

        $membership_query = "SELECT * FROM Membership m INNER JOIN User u WHERE m.membership_id = u.membership_id AND u.user_id = '" . $_SESSION['id'] . "'";
        $membership_result = mysqli_query($conn, $membership_query);
        $membership = mysqli_fetch_assoc($membership_result);

        $_SESSION['membership_id'] = $membership['membership_id'];

    }
    if($_SESSION["type"] == 'Vendor') {
        $sql = "SELECT * FROM Kiosk WHERE kiosk_id = '".$_SESSION['kiosk_id']."'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['kiosk_status'] = $row["status"];
            $_SESSION['kiosk_name'] = $row['kiosk_name'];
        }
    }
    $arr = array($status, $type);
    echo json_encode($arr);
}
?>