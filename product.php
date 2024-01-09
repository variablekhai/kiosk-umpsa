<?php

//get menuid from url
$menuid = $_GET['id'];

//get menu details from database
include_once './php_function/initdb.php';
$sql = "SELECT * FROM Menu WHERE menu_id = '$menuid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  exit();
}

//get menu name
$menu_name = $row['name'];
$menu_price = $row['price'];
$menu_desc = $row['description'];
$menu_img = $row['image'];
$kiosk_id = $row['kiosk_id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kiosk@UMPSA | <?php echo $menu_name ?></title>
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
            <?php echo $menu_name ?></h1>
          <p class="text-center md:text-left lg:text-left text-sm poppins text-gray-500 leading-relaxed select-none"><?php echo $menu_desc ?></p>
          <div class="flex items-center justify-center md:justify-start lg:justify-start space-x-6 pt-8">
            <!-- Todo: Calculate price based on quantity added (price * quantity) -->
            <h1 class="text-3xl font-bold text-black poppins select-none">RM <?php echo number_format($menu_price, 2) ?></h1>

            <!-- Quantity -->
            <div class="flex items-center border border-gray-200 px-4 py-2 space-x-6 rounded-full">
              <button
                id="minus_quantity"
                class="text-2xl bg-[#5B86FF] w-8 h-8 rounded-full text-white hover:scale-105 transform transition duration-500 cursor-pointer p-1 flex items-center justify-center">
                <i class="fa-solid fa-minus fa-xs" style="color: #ffffff;"></i>
              </button>


              <span id="quantity" className="text-lg text-gray-700 poppins select-none">1</span>

              <button
                id="add_quantity"
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
            <img src="<?php echo $menu_img ?>"
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

    // Quantity
    $('#add_quantity').click(function() {
      var quantity = parseInt($('#quantity').text());
      quantity++;
      $('#quantity').text(quantity);
    });

    $('#minus_quantity').click(function() {
      var quantity = parseInt($('#quantity').text());
      if (quantity > 1) {
        quantity--;
        $('#quantity').text(quantity);
      }
    });

    $('#btnAddToCart').click(function() {
      var quantity = parseInt($('#quantity').text());

      $.ajax({
        type: "POST",
        url: "./php_function/cartSession.php",
        data: {
          menu_id: '<?php echo $menuid ?>',
          quantity: quantity,
          kiosk_id: '<?php echo $kiosk_id ?>'
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