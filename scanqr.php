<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Kiosk@UMPSA | Home</title>
  <?php include("php_function/head.php"); ?>
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      function onScanSuccess(decodedText, decodedResult) {
        window.location.href = `product.php?id=${decodedText}&inpurchase=1`;
      }

      function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        console.warn(`Code scan error = ${error}`);
      }

      let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
          fps: 10,
          qrbox: {
            width: 500,
            height: 500
          }
        },
        /* verbose= */
        false);
      html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    })
  </script>
</head>

<body class="poppins">
  <?php include 'php_function/navbar.php';?>

  <!-- Start Header -->
  <div class="mt-24" id="reader" width="600px"></div>
  <!-- End Header -->
</body>

</html>