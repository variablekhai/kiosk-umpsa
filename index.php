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
      <p class="bg-[#5B86FF] text-white rounded-full px-6 py-2 cursor-pointer">
        All
      </p>
      <p class="rounded-full px-6 py-2 cursor-pointer">
        <i class="fa-solid fa-store"></i>
        Kiosk A
      </p>
      <p class="rounded-full px-6 py-2 cursor-pointer">
        <i class="fa-solid fa-store-slash"></i>
        Kiosk B
      </p>
      <p class="rounded-full px-6 py-2 cursor-pointer">
        <i class="fa-solid fa-store"></i>
        Kiosk C
      </p>
    </div>
    <!-- Start Stall Chips -->

    <!-- Start Food Item -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-12">

      <!-- Individual Food -->
      <div
        class="bg-white border border-gray-100 transition transform duration-700 hover:shadow-xl hover:scale-105 p-4 rounded-lg relative">
        <span
          class="text-[#5B86FF] bg-[#d5e0ff] border border-[#5B86FF] rounded-full text-primary text-sm poppins px-4 py-1 inline-block mb-4 ">Kiosk B</span>
        <img class="w-64 mx-auto transform transition duration-300 hover:scale-105"
          src="https://png.pngtree.com/png-clipart/20231016/original/pngtree-top-view-hainanese-chicken-rice-served-on-a-plate-with-soup-png-image_13323477.png"
          alt="" />
        <div class="flex flex-col items-center my-3 space-y-2">
          <h1 class="text-gray-900 text-lg">Nasi Ayam</h1>
          <p class="text-gray-500 text-sm text-center">Succulent braised chicken meat with fragrant rice</p>
          <h2 class="text-gray-900 text-2xl font-bold">RM12.00</h2>
          <h6 class="text-[#5B86FF] text-sm text-center">11 in stock</h6>
          <button
            onclick="window.location.href='product.html'"
            class="bg-[#5B86FF] text-white px-8 py-2 focus:outline-none rounded-full mt-24 transform transition duration-300 hover:scale-105">Order
            Now</button>
        </div>
      </div>

      <!-- Individual Food -->
      <div
        class="bg-white border border-gray-100 transition transform duration-700 hover:shadow-xl hover:scale-105 p-4 rounded-lg relative">
        <span
          class="text-[#5B86FF] bg-[#d5e0ff] border border-[#5B86FF] rounded-full text-primary text-sm poppins px-4 py-1 inline-block mb-4 ">Kiosk
          C</span>
        <img class="w-64 mx-auto transform transition duration-300 hover:scale-105"
          src="https://png.pngtree.com/png-clipart/20230320/original/pngtree-plate-with-tasty-waffles-png-image_8997543.png"
          alt="" />
        <div class="flex flex-col items-center my-3 space-y-2">
          <h1 class="text-gray-900 text-lg">Waffle</h1>
          <p class="text-gray-500 text-sm text-center">Crispy on the outside, chewy on the inside</p>
          <h2 class="text-gray-900 text-2xl font-bold">RM4.00</h2>
          <h6 class="text-[#5B86FF] text-sm text-center">Sold Out</h6>
          <button disabled
            class="bg-[#2e4380] text-white px-8 py-2 focus:outline-none rounded-full mt-24 transform transition duration-300 hover:scale-105">Sold
            Out</button>
        </div>
      </div>

      <!-- Individual Food -->
      <div
        class="bg-white border border-gray-100 transition transform duration-700 hover:shadow-xl hover:scale-105 p-4 rounded-lg relative">
        <span
          class="text-[#5B86FF] bg-[#d5e0ff] border border-[#5B86FF] rounded-full text-primary text-sm poppins px-4 py-1 inline-block mb-4 ">Kiosk
          A</span>
        <img class="mt-4 w-auto h-60 scale-105 mx-auto transform transition duration-300 hover:scale-110"
          src="./assets/nasi_lemak.png" alt="" />
        <div class="flex flex-col items-center my-3 space-y-2">
          <h1 class="text-gray-900 text-lg">Nasi Lemak</h1>
          <p class="text-gray-500 text-sm text-center">Malaysian traditional cuisine</p>
          <h2 class="text-gray-900 text-2xl font-bold">RM12.00</h2>
          <h6 class="text-[#5B86FF] text-sm text-center">3 in stock</h6>
          <button
            class="bg-[#5B86FF] text-white px-8 py-2 focus:outline-none rounded-full mt-24 transform transition duration-300 hover:scale-105">Order
            Now</button>
        </div>
      </div>

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
  
  // Selected shop
  document.querySelectorAll('.shop-chips p').forEach(shop => {
    shop.addEventListener('click', () => {
      // Reset background color for all shops
      document.querySelectorAll('.shop-chips p').forEach(s => {
        s.classList.remove('bg-[#5B86FF]');
        s.classList.remove('text-white');
      });
      // Set selected shop to have different visual
      shop.classList.add('bg-[#5B86FF]');
      shop.classList.add('text-white');
    });
  });
</script>