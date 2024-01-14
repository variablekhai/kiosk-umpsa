<?php
include './php_function/initdb.php';
session_start();

$cart = $_SESSION['cart'];

$totalPrice = 0;
foreach($cart as $item) {
    $totalPrice += $item['quantity']*$item['price'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiosk@UMPSA | Receipt</title>
</head>

<body>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kiosk@UMPSA | Receipt</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <div class="container">

            <div class="receipt_header">
                <h1>Receipt of Sale <span>Kiosk@UMPSA</span></h1>
                <h2>Address: Fakulti Komputeran <span>Tel: +09-424 4651</span></h2>
            </div>

            <div class="receipt_body">

                <div class="date_time_con">
                    <div class="date"></div>
                </div>

                <div class="items">
                    <table>

                        <thead>
                            <th>QTY</th>
                            <th>ITEM</th>
                            <th>AMOUNT(RM)</th>
                        </thead>

                        <tbody>
                            <?php foreach($cart as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['quantity']?></td>
                                        <td><?php echo $item['name'] ?></td>
                                        <td><?php echo number_format($item['quantity']*$item['price'], 2)?></td>
                                    </tr>
                            <?php } ?>

                        </tbody>

                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td><?php echo 'RM',number_format($totalPrice, 2) ?></td>
                            </tr>
                        </tfoot>

                    </table>
                </div>

            </div>


            <h3>Thank You!</h3>

        </div>

    </body>

    </html>

    <script>
        window.addEventListener('beforeunload', function() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', './php_function/unset_cart.php', true);
            xhr.send();
        });
    </script>
</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Source Sans Pro', sans-serif;
}

.container {
    display: block;
    width: 100%;
    background: #fff;
    max-width: 350px;
    padding: 25px;
    margin: 50px auto 0;
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
}

.receipt_header {
    padding-bottom: 40px;
    border-bottom: 1px dashed #000;
    text-align: center;
}

.receipt_header h1 {
    font-size: 20px;
    margin-bottom: 5px;
    text-transform: uppercase;
}

.receipt_header h1 span {
    display: block;
    font-size: 25px;
}

.receipt_header h2 {
    font-size: 14px;
    color: #727070;
    font-weight: 300;
}

.receipt_header h2 span {
    display: block;
}

.receipt_body {
    margin-top: 25px;
}

table {
    width: 100%;
}

thead, tfoot {
    position: relative;
}

thead th:not(:last-child) {
    text-align: left;
}

thead th:last-child {
    text-align: right;
}

thead::after {
    content: '';
    width: 100%;
    border-bottom: 1px dashed #000;
    display: block;
    position: absolute;
}

tbody td:not(:last-child), tfoot td:not(:last-child) {
    text-align: left;
}

tbody td:last-child, tfoot td:last-child{
    text-align: right;
}

tbody tr:first-child td {
    padding-top: 15px;
}

tbody tr:last-child td {
    padding-bottom: 15px;
}

tfoot tr:first-child td {
    padding-top: 15px;
}

tfoot::before {
    content: '';
    width: 100%;
    border-top: 1px dashed #000;
    display: block;
    position: absolute;
}

tfoot tr:first-child td:first-child, tfoot tr:first-child td:last-child {
    font-weight: bold;
    font-size: 20px;
}

.date_time_con {
    display: flex;
    justify-content: center;
    column-gap: 25px;
}

.items {
    margin-top: 25px;
}

h3 {
    border-top: 1px dashed #000;
    padding-top: 10px;
    margin-top: 25px;
    text-align: center;
    text-transform: uppercase;
}
</style>

</html>