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
        $status = 'Account already exists';
    }
    else {
        $user_id = uniqid();
        $membership_id = uniqid();
        $now = date('Y-m-d H:i:s');

        //Change this later
        $user_qr = '123456789';

        $membership_sql = "INSERT INTO Membership VALUES ('$membership_id', 0)";
        mysqli_query($conn, $membership_sql);
        $user_sql = "INSERT INTO User VALUES ('$user_id', '$membership_id', '$email', '$password', '$type', '$name', '$email', '$now', '$user_qr', NULL)";
        if (mysqli_query($conn, $user_sql)) {
            $status = 'true';

            //Insert into Vendor table
            if($type == 'Vendor') {
                $vendor_id = uniqid();
                $vendor_qr = '123456789';
                $vendor_sql = "INSERT INTO Vendor VALUES ('$vendor_id', '$user_id', '$vendor_qr', '0')";

                if (mysqli_query($conn, $vendor_sql)) {
                    $status = 'true';
                }
                else {
                    $status = "Error: " . $vendor_sql . "<br>" . mysqli_error($conn);
                }
            }

        } 
        else {
            $status = "Error: " . $user_sql . "<br>" . mysqli_error($conn);
        }
    }
    echo $status;
}
    
?>