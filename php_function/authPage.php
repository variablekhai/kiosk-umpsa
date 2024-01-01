<?php
session_start();
if(!isset($_SESSION['email']) && empty($_SESSION['password'])) {
    echo <<<HTML
    <script>window.location = "/kiosk-umpsa/";</script>
    HTML;
}
?>