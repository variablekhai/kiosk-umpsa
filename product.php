<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kiosk@UMPSA | Product Name</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <script src="https://replit.com/public/js/replit-badge-v2.js" theme="dark" position="bottom-right"></script>
  <script src="sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script src="./jquery/jquery-3.7.1.min.js"></script>
</head>

<body>

  <!-- Start Navbar -->
  <header class="bg-transparent bg-transparent fixed z-50 top-0 left-0 w-full transition duration-500">
    <nav class="flex items-center max-w-screen-xl mx-auto px-6 py-3">
      <!-- Left Side -->
      <div class="flex flex-grow">
        Kiosk@UMPSA
      </div>
      <!-- Right Side -->
      <div class="flex items-center justify-end space-x-6">
        <button>Sign In</button>
        <button
          class="bg-[#5B86FF] px-6 py-3 text-white poppins rounded-full ring-[#abc1ff] focus:outline-none focus:ring-4 transform transition duration-700 hover:scale-    105">Sign
          Up</button>
      </div>
    </nav>
  </header>
  <!-- End Navbar -->

  <!-- Start Main Body -->
  <main class="max-w-screen-xl mx-auto px-6 my-16">

    <!-- Back Button -->
    <div class="relative top-8">
      <a href='/' className="hover:underline poppins text-gray-700 select-none flex items-center space-x-2">
        <i class="fa-solid fa-arrow-left"></i> <span>Back</span>
      </a>
    </div>

    <div class="flex flex-col justify-center items-center h-screen">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-10">

        <!-- Left Side -->
        <div class="flex flex-col justify-center">
          <h1
            class="text-center md:text-left lg:text-left text-3xl lg:text-4xl font-semibold poppins pb-4 text-gray-700 select-none">
            Nasi Ayam</h1>
          <p class="text-center md:text-left lg:text-left text-sm poppins text-gray-500 leading-relaxed select-none">Gay
            one the what walk then she. Demesne mention promise you justice arrived way.Amazing foods are or and
            increasing to in especially inquietude companions acceptance admiration.Outweigh it families distance
            wandered ye..</p>
          <div class="flex items-center justify-center md:justify-start lg:justify-start space-x-6 pt-8">
            <!-- Todo: Calculate price based on quantity added (price * quantity) -->
            <h1 class="text-3xl font-bold text-black poppins select-none">RM 12.00</h1>

            <!-- Quantity -->
            <div class="flex items-center border border-gray-200 px-4 py-2 space-x-6 rounded-full">
              <button
                class="text-2xl bg-[#5B86FF] w-8 h-8 rounded-full text-white hover:scale-105 transform transition duration-500 cursor-pointer p-1 flex items-center justify-center">
                <i class="fa-solid fa-minus fa-xs" style="color: #ffffff;"></i>
              </button>


              <span className="text-lg text-gray-700 poppins select-none">1</span>

              <button
                class="text-2xl bg-[#5B86FF] w-8 h-8 rounded-full text-white hover:scale-105 transform transition duration-500 cursor-pointer p-1 flex items-center justify-center">
                <i class="fa-solid fa-plus fa-xs" style="color: #ffffff;"></i>
              </button>
            </div>
          </div>

          <!-- Add to Cart Button -->
          <div class="mt-8 flex items-center justify-center md:justify-start lg:justify-start">
            <button
              id="btnAddToCart"
              class="flex items-center space-x-3 bg-[#5B86FF] px-6 py-3 text-white poppins rounded-full ring-[#abc1ff] focus:outline-none focus:ring-4 transform transition duration-700 hover:scale-105"">
              <span>Add to Cart</span>
            </button>
          </div>
          
        </div>

        <!-- Right Side -->
        <div class="">
            <img src="
              https://png.pngtree.com/png-clipart/20231016/original/pngtree-top-view-hainanese-chicken-rice-served-on-a-plate-with-soup-png-image_13323477.png"
              className="w-3/4 md:w-3/4 lg:w-full mx-auto" alt="food" />
          </div>
        </div>
      </div>

  </main>
  <!-- End Main Body -->
</body>

</html>
<script src="script.js"></script>
<script>
  // DO NOT DELETE I REPEAT DO NOT DELETE PLEASSEESAEASEASE
  $(document).ready(function() {
    $('#btnAddToCart').click(function() {
      var menuId = 1;
      var quantity = 1;

      $.ajax({
        type: "POST",
        url: "./php_function/cartSession.php",
        data: {
          menu_id: 'test123', //CHANGE THESE LATER AFTER INTEGRATING WITH REAL MENU
          quantity: 3,
          kiosk_id: '0'
        },
        success: function(data) {
          Swal.fire({
            title: "Success",
            text: "Item added to cart",
            icon: "success",
            showCancelButton: true,
            confirmButtonText: 'Buy More',
            cancelButtonText: 'Checkout',
            confirmButtonColor: '#5B86FF',
            cancelButtonColor: '#5B86FF'
          }).then(function(result) {
            if (result.isConfirmed) {
              window.location.href = "./index.php";
            } else {
              window.location.href = "./orders.php";
            }
          });
        },
        error: function() {
          Swal.fire({
            title: "Error",
            text: "Failed to add item to cart",
            icon: "error",
            confirmButtonText: 'Okay',
            confirmButtonColor: '#5B86FF'
          });
        }
      });
    });
  });
</script>