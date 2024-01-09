<?php

include 'php_function/initdb.php';

$menu_query = "SELECT * FROM Menu";
$menu_result = mysqli_query($conn, $menu_query);

if (!$menu_result) {
  echo "Error: " . $menu_query . "<br>" . mysqli_error($conn);
  exit();
}

//fetch and store all menu in array
$menu = array();
while ($row = mysqli_fetch_assoc($menu_result)) {
  $menu_array[] = $row;
}

//get all kiosk
$kiosk_query = "SELECT * FROM Kiosk";
$kiosk_result = mysqli_query($conn, $kiosk_query);

if (!$kiosk_result) {
  echo "Error: " . $kiosk_query . "<br>" . mysqli_error($conn);
  exit();
}

//fetch and store all kiosk in array
$kiosk = array();
while ($row = mysqli_fetch_assoc($kiosk_result)) {
  $kiosk_array[] = $row;
}

// Check if a shop chip is selected
if (isset($_GET['kiosk_id'])) {
  $selected_kiosk_id = $_GET['kiosk_id'];
  // Filter menu items based on the selected shop
  $menu_array = array_filter($menu_array, function ($menu) use ($selected_kiosk_id) {
    return $menu['kiosk_id'] == $selected_kiosk_id;
  });
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Kiosk@UMPSA | Home</title>
  <script src="https://replit.com/public/js/replit-badge-v2.js" theme="dark" position="bottom-right"></script>
  <?php include ("php_function/head.php"); ?>
</head>

<body class="poppins">

  <?php include 'php_function/navbar.php'; ?>
  <!-- Start Header -->
  <section class="header-banner h-96 w-full bg-[#fcf4e0] ">
    <div class="flex flex-col items-center justify-center h-full">
      <h1 class="text-center text-3xl md:text-4xl lg:text-5xl font-semibold text-gray-700">Recharge between lectures<br>
        with tasty <a class="text-[#5B86FF]">campus</a> eats
      </h1>

      <div
        class="border border-[#5B86FF] rounded-full p-1 box-border mt-8 bg-white overflow-hidden ring-[#000] focus:ring-4 w-96 flex items-center">
        <input type="text" class="rounded-full px-4 focus:outline-none w-full bg-transparent"
          placeholder="Search here ......." />
        <button
          class="text-sm bg-[#5B86FF] py-3 px-6 rounded-full text-white ring-[#abc1ff] focus:ring-4 transition duration-300 hover:scale-105 transform">Search</button>
      </div>
    </div>
  </section>
  <!-- End Header -->

  <!-- Start Main Body -->
  <section class="my-12 max-w-screen-xl mx-auto px-6">

    <!-- Start Stall Chips -->
    <div class="shop-chips flex items-center justify-center space-x-6">
      <p id="all" class="<?php echo isset($_GET['kiosk_id']) ? '' : 'bg-[#5B86FF] text-white'  ?> rounded-full px-6 py-2 cursor-pointer">
        <a href="?">All</a>
      </p>
      <?php foreach ($kiosk_array as $kiosk) : ?>
        <p id="<?php echo $kiosk['kiosk_id'] ?>" class="<?php echo $selected_kiosk_id == $kiosk['kiosk_id'] ? 'bg-[#5B86FF] text-white' : '' ?> rounded-full px-6 py-2 cursor-pointer">
          <?php if ($kiosk['status'] == 'open') : ?>
            <i class="fa-solid fa-store"></i>
          <?php else : ?>
            <i class="fa-solid fa-store-slash"></i>
          <?php endif; ?>
          <a href="?kiosk_id=<?php echo $kiosk['kiosk_id'] ?>"><?php echo $kiosk['kiosk_name'] ?></a>
        </p>
      <?php endforeach; ?>
    </div>
    <!-- Start Stall Chips -->

    <!-- Start Food Item -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-12">

      <?php foreach ($menu_array as $menu) { ?>
      <!-- Individual Food -->
      <div
        class="bg-white border border-gray-100 transition transform duration-700 hover:shadow-xl hover:scale-105 p-4 rounded-lg relative">
        <?php
        foreach ($kiosk_array as $kiosk) {
          if ($kiosk['kiosk_id'] == $menu['kiosk_id']) {
            $kiosk_name = $kiosk['kiosk_name'];
          }
        }
        ?>
        <span
          class="text-[#5B86FF] bg-[#d5e0ff] border border-[#5B86FF] rounded-full text-primary text-sm poppins px-4 py-1 inline-block mb-4 "><?php echo $kiosk_name ?></span>
        <img class="w-64 mx-auto transform transition duration-300 hover:scale-105"
          src="<?php echo $menu['image'] ?>"
          alt="" />
        <div class="flex flex-col items-center my-3 space-y-2">
          <h1 class="text-gray-900 text-lg"><?php echo $menu['name'] ?></h1>
          <p class="text-gray-500 text-sm text-center"><?php echo $menu['description'] ?></p>
          <h2 class="text-gray-900 text-2xl font-bold">RM<?php echo number_format($menu['price'], 2) ?></h2>
          <?php if ($menu['quantity_remaining'] == 0) : ?>
            <h6 class="text-[#5B86FF] text-sm text-center">Sold Out</h6>
            <button disabled
              class="bg-[#2e4380] text-white px-8 py-2 focus:outline-none rounded-full mt-24 transform transition duration-300 hover:scale-105">Sold
              Out</button>
          <?php else : ?>
          <h6 class="text-[#5B86FF] text-sm text-center"><?php echo $menu['quantity_remaining'] ?> in stock</h6>
          <button
            onclick="window.location.href='product.php?id=<?php echo $menu['menu_id'] ?>'"
            class="bg-[#5B86FF] text-white px-8 py-2 focus:outline-none rounded-full mt-24 transform transition duration-300 hover:scale-105">Order
            Now</button>
          <?php endif; ?>
        </div>
      </div>
      <?php } ?>

      <!-- End Food Item -->
  </section>
  <!-- End Main Body -->

  <!-- Start Footer -->
  <footer class="bg-[#1b284c] px-6 py-12">
    <div class="max-w-screen-xl mx-auto px-6">
      <div class="flex items-center pt-8">
        <div class="flex flex-col gap-0 leading-none flex-grow">
          <span class="text-white">Web Engineering Sem I 23/24</span><br>
          <span class="text-white text-sm">Dr. Noorlin Binti Mohd Ali</span>
        </div>

        <div class="flex justify-end items-center space-x-6">
          <span class="text-white cursor-pointer">Khai</span>
          <span class="text-white cursor-pointer">Juel</span>
          <span class="text-white cursor-pointer">Iqram</span>
          <span class="text-white cursor-pointer">Aizuddin</span>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->
</body>

</html>

<style>
  body {
    overflow-y: scroll;
    scrollbar-width: none;
    -ms-overflow-style: none;
  }

  body::-webkit-scrollbar {
    display: none;
  }

  .header-banner {
    background-image: url('./assets/banner.png');
    background-size: cover;
    height: 500px;
  }
</style>
<script src="script.js"></script>
<script>
</script>