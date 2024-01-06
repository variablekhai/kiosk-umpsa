<?php

include '../php_function/initdb.php';
//get all menu data in Menu table by using InPurchaseMenu menu_id as reference
$query = "SELECT * FROM Menu m INNER JOIN InPurchaseMenu i ON m.menu_id = i.menu_id";
$result = mysqli_query($conn, $query);
$menu = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kiosk@UMPSA | In-Store</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <script src="https://replit.com/public/js/replit-badge-v2.js" theme="dark" position="bottom-right"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <script src="../jquery/jquery-3.7.1.min.js"></script>
</head>

<body class="poppins">

  <div class="flex items-center justify-center mt-8">
    <h1 class="text-center text-3xl md:text-4xl lg:text-5xl font-semibold text-gray-700">Kiosk A</h1>
  </div>

  <!-- Start Main Body -->
  <section class="my-12 max-w-screen-xl mx-auto px-6">

    <!-- Start Food Item -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-12">

      <!-- Individual Food -->
      <?php foreach ($menu as $item) { ?>
        <div class="bg-white border border-gray-100 transition transform duration-700 hover:shadow-xl hover:scale-105 p-4 rounded-lg relative">
          <img class="w-64 mx-auto transform transition duration-300 hover:scale-105" src="<?php echo $item['image']; ?>" alt="" />
          <div class="flex flex-col items-center my-3 space-y-2">
            <h1 class="text-gray-900 text-lg"><?php echo $item['name']; ?></h1>
            <p class="text-gray-500 text-sm text-center"><?php echo $item['description']; ?></p>
            <h2 class="text-gray-900 text-2xl font-bold">RM<?php echo $item['price']; ?></h2>
            <div class="qr-modal"></div>
            <input type="hidden" class="menu-id" value="<?php echo $item['menu_id']; ?>">
          </div>
        </div>
      <?php } ?>
      <!-- End Individual Food -->
      </div>

      <!-- End Food Item -->
  </section>
  <!-- End Main Body -->

</body>

</html>

<script>
  $(document).ready(function() {
    $('.menu-id').each(function() {
      var menuId = $(this).val();
      var qrModal = $(this).siblings('.qr-modal');

      $.ajax({
        type: "POST",
        url: "../php_function/generate_qr.php",
        data: {
          id: menuId
        },
        success: function(data) {
          qrModal.html(`
            <div class="flex flex-col items-center justify-center">
              <img class="w-40 h-40" src="${data}" alt="QR Code">
            </div>
          `);
        }
      });
    });
  });
</script>