<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Example</title>
</head>
<body>
<?php
include "phpqrcode/qrlib.php";

$input = uniqid();

// Start output buffering
ob_start();

// Generate QR code
QRcode::png($input, null, QR_ECLEVEL_H);

// Capture the output into a variable
$qrCodeData = ob_get_clean();

// Convert QR code image data to base64
$qrCodeBase64 = base64_encode($qrCodeData);
$src = 'data: image/png;base64,' . $qrCodeBase64;

echo "<b>$input</b><br>";
echo '<img src="', $src, '" alt="QR Code">';
?>
</body>
</html>
