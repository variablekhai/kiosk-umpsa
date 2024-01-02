<?php
function generateQR($input) {
    // Start output buffering
    ob_start();

    // Generate QR code
    QRcode::png($input, null, QR_ECLEVEL_H);

    // Capture the output into a variable
    $qrCodeData = ob_get_clean();

    // Convert QR code image data to base64
    $qrCodeBase64 = base64_encode($qrCodeData);
    $src = 'data: image/png;base64,' . $qrCodeBase64;

    echo $src;
    ob_end_clean();
}
?>