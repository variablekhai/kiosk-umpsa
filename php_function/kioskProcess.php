<?php
include 'initdb.php';

$action = $_GET['action'];
$kiosk_id = $_GET['kioskId'];

$sql = "UPDATE Kiosk SET status='$action' WHERE kiosk_id = $kiosk_id";
$result = mysqli_query($conn, $sql);
session_start();
$_SESSION['kiosk_status'] = $action;

header("Location: ../vendor/dashboard");
?>