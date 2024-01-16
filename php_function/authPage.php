<?php
session_start();
if(!isset($_SESSION['email']) && empty($_SESSION['password'])) {
    echo <<<HTML
    <script>location.href = "../index";</script>
    HTML;
}
session_abort();
?>