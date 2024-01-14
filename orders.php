<?php
include './php_function/initdb.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kiosk@UMPSA | Orders</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <script src="https://replit.com/public/js/replit-badge-v2.js" theme="dark" position="bottom-right"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script src="./jquery/jquery-3.7.1.min.js"></script>
</head>

<body class="poppins">

  <!-- Start Navbar -->
  <?php
  include('./php_function/navbar.php');
  if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = 'guest';
    $_SESSION["name"] = "Guest";
    $_SESSION['cart'] = array();
  }

  $inpurchase = isset($_GET['inpurchase']) ? $_GET['inpurchase'] : 0;

  if (isset($_SESSION['membership_id'])) {
    $membership_id = $_SESSION['membership_id'];
    $membership_query = "SELECT * FROM Membership m INNER JOIN User u WHERE m.membership_id = u.membership_id AND u.user_id = '" . $_SESSION['id'] . "'";
    $membership_result = mysqli_query($conn, $membership_query);
    $membership = mysqli_fetch_assoc($membership_result);

    $points = $membership['membership_point'];
  }

  $cart = [];

  if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
  }
  ?>

  <!-- Main Body -->
  <main class="h-screen banner">
    <div class="max-w-screen-xl py-20 mx-auto px-6">

      <!-- Back Button -->
      <div class="relative top-8">
        <a href="./index.php" class="hover:underline poppins text-gray-700 select-none flex items-center space-x-2">
          <i class="fa-solid fa-arrow-left"></i> <span>Back</span>
        </a>
      </div>

      <div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-10">

          <!-- Left Side -->
          <div class="col-span-1">
            <div class="flex flex-col mt-20">
              <h1 class="text-5xl poppins pb-4 text-gray-900"><b><?php echo isset($_GET['inpurchase']) ? "In-Purchase" : "Order" ?></b></h1>
              <h1 class="text-2xl poppins pb-4 border-b border-gray-500 text-gray-700">Edit Payment Details</h1>
              <form id="paymentForm" class="my-4">
                <div class="flex flex-col space-y-3">

                  <main class="grid w-full place-items-center">
                    <div class="grid w-full grid-cols-2 gap-2 rounded-lg p-2 glass border border-gray-300">
                      <div>
                        <input type="radio" name="option" id="online" value="Online" class="peer hidden" />
                        <label for="online" class="block cursor-pointer select-none rounded-lg p-2 text-center peer-checked:bg-[#5B86FF] peer-checked:font-medium peer-checked:text-white">Online Payment</label>
                      </div>

                      <div>
                        <input type="radio" name="option" id="cash" value="Cash" class="peer hidden" checked />
                        <label for="cash" class="block cursor-pointer select-none rounded-lg p-2 text-center peer-checked:bg-[#5B86FF] peer-checked:font-medium peer-checked:text-white">Cash</label>
                      </div>
                    </div>
                  </main>

                  <!-- Todo: For registered user, display their name, unregistered user, let them enter name, make it required -->
                  <?php
                  $name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
                  ?>
                  <input value="<?php echo $name ?>" id="name" placeholder="Recipient Name" class="glass w-full px-4 py-3 rounded-lg ring-[#abc1ff] focus:ring-4 focus:outline-none transition duration-300 border border-gray-300 focus:shadow-xl" required>

                  <div id="cardPayment">
                    <!-- Todo: Only shows cards field, if 'Online payment' -->
                    <input id="cardno" placeholder="Card No." class="glass w-full px-4 py-3 rounded-lg ring-[#abc1ff] focus:ring-4 focus:outline-none transition duration-300 border border-gray-300 focus:shadow-xl mb-3">

                    <div class="grid grid-cols-2 gap-5">
                      <input id="expiry" placeholder="Expiry Date" class="glass w-full px-4 py-3 rounded-lg ring-[#abc1ff] focus:ring-4 focus:outline-none transition duration-300 border border-gray-300 focus:shadow-xl">
                      <input id="cvv" placeholder="CVV" class="glass w-full px-4 py-3 rounded-lg ring-[#abc1ff] focus:ring-4 focus:outline-none transition duration-300 border border-gray-300 focus:shadow-xl">
                    </div>

                  </div>


                  <?php
                  if (isset($_SESSION['membership_id'])) {
                  ?>
                    <p>You have <strong><?php echo $points ?></strong> points available</p>
                    <input min="1" max="<?php echo $points ?>" type="number" id="points" placeholder="Enter points amount to use" class="glass w-full px-4 py-3 rounded-lg ring-[#abc1ff] focus:ring-4 focus:outline-none transition duration-300 border border-gray-300 focus:shadow-xl">
                  <?php
                  } else {
                    echo "<p class='mt-2'>Please <a class='text-[#5B86FF] underline' href='./signin.php'>log in</a> to earn points.</p>";
                  }
                  ?>

                </div>
              </form>
            </div>
          </div>

          <!-- Right Side -->
          <div class="col-span-1">
            <div class="glass p-6 box-border rounded-lg">
              <div class="flex flex-col space-y-4 mb-3">
                <p class="poppins text-gray-700 text-2xl">Items in Cart</p>
              </div>

              <!-- Food List -->
              <div class="flex flex-col space-y-3 h-64 overflow-y-scroll removeScroll">
                <?php
                if (empty($cart)) {
                  echo "No items in cart";
                } else {
                  foreach ($cart as $item) {
                ?>
                    <div class="rounded-lg p-4 flex space-x-3">

                      <div class="flex">
                        <img class="w-24 object-contain" src="<?php echo $item['image'] ?>" alt="" />
                      </div>

                      <div class="flex flex-col space-y-3 flex-grow">
                        <h5 class="text-base poppins text-gray-700"><?php echo $item['name'] ?></h5>
                        <h1 class="font-semibold text-lg text-primary poppins">RM<?php echo $item['price'] ?></h1>
                        <!-- <p class="text-sm poppins text-gray-400"><?php echo $item['kiosk'] ?></p> -->
                      </div>

                      <div class="flex items-center px-4 py-2 space-x-3">
                        <span class="text-lg text-gray-700 poppins select-none"><?= $item['quantity'] >= 2 ? $item['quantity'] . ' items' : $item['quantity'] . ' item' ?></span>
                      </div>

                      <div class="flex flex-col items-center justify-center">
                        <i onclick="onItemDelete('<?php echo $item['id'] ?>')" id="deleteItem" class="fa-solid fa-trash cursor-pointer transform transition hover:scale-105 duration-500"></i>
                      </div>
                    </div>
                <?php
                  }
                }
                ?>
              </div>


              <div class="flex flex-col space-y-3 my-4">
                <?php
                $totalPrice = 0; // Initialize total price variable
                $totalPointsEarned = 0;

                // Calculate total price from cart session
                foreach ($cart as $item) {
                  $totalPrice += $item['price'] * $item['quantity'];

                  //make a calculation for points
                  $totalPointsEarned += $item['price'] * $item['quantity'] * 2;
                }
                ?>
                <div class="flex items-center">
                  <span class="flex-grow poppins text-gray-700">Subtotal</span>
                  <span class="poppins font-semibold text-black">RM<?php echo number_format($totalPrice, 2); ?></span>
                </div>
                <?php if (isset($_SESSION['membership_id'])) { ?>
                  <div class="flex items-center">
                    <!-- Todo: For registered user, calculate points based on RM1 = 2 points, unregistered user: signup to receive points -->
                    <span class="flex-grow poppins text-gray-700">Points Earned</span>
                    <span class="poppins font-semibold text-black"><?php echo $totalPointsEarned ?> points</span>
                  </div>
                <?php } ?>
                <div class="flex items-center">
                  <!-- Todo: Calculation -->
                  <span class="flex-grow poppins text-gray-700 text-xl">Total</span>
                  <span id="total" class="poppins font-semibold text-black text-xl">RM<?php echo number_format($totalPrice, 2); ?></span>
                  <span id="points_used"></span>
                </div>
              </div>

              <?php
              if (($_SESSION['id'] == 'guest')) {
              ?>
                <button onclick="onSubmitGuest()" class="w-full py-3 bg-[#5B86FF] text-white ring-[#abc1ff] focus:outline-none focus:ring-4 mt-6 rounded-lg transition duration-300 poppins">Place
                  Order
                </button>
              <?php
              } else {
              ?>
                <button onclick="onSubmit()" class="w-full py-3 bg-[#5B86FF] text-white ring-[#abc1ff] focus:outline-none focus:ring-4 mt-6 rounded-lg transition duration-300 poppins">Place
                  Order
                </button>
              <?php
              }
              ?>
            </div>
          </div>
        </div>


      </div>
  </main>
</body>

</html>
<script src="script.js"></script>

<script>
  $(document).ready(function() {
    $('#cardPayment').hide();

    $('input[type=radio][name=option]').change(function() {
      if (this.value == 'Online') {
        $('#cardPayment').show();
      } else if (this.value == 'Cash') {
        $('#cardPayment').hide();
      }
    });
  });

  function onSubmit() {

    var inpurchase = <?php echo isset($inpurchase) ? $inpurchase : '0' ?>;
    //get radio for payment
    var paymentType = $('input[name=option]:checked').val();

    var name = $('#name').val();
    var points = $('#points').val();
    var cart = <?php echo json_encode($cart) ?>;
    var totalPrice = <?php echo $totalPrice ?>;
    var totalPointsEarned = <?php echo $totalPointsEarned ?>;
    var totalPointsUsed = $('#points').val() ? $('#points').val() : 0;
    var membership_id = '<?php echo isset($membership_id) ? $membership_id : ""; ?>';
    var user_id = '<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : "" ?>';

    //Send order request
    if (cart.length === 0) {
      Swal.fire({
        icon: 'warning',
        title: 'Empty Cart',
        text: 'Your cart is empty. Please add items before placing an order.',
        confirmButtonText: 'Okay',
        confirmButtonColor: '#5B86FF'
      });
    } else {
      $.ajax({
        url: './php_function/createOrder.php',
        type: 'POST',
        data: {
          name: name,
          points: points,
          cart: cart,
          totalPrice: totalPrice,
          totalPointsEarned: totalPointsEarned,
          totalPointsUsed: totalPointsUsed,
          membership_id: membership_id,
          paymentType: paymentType,
          inpurchase: inpurchase,
        },
        success: function(response) {
          console.log(response);
          Swal.fire({
            icon: 'success',
            title: 'Order Placed!',
            text: 'Your order has been placed and is being prepared!',
            confirmButtonText: 'Okay',
            confirmButtonColor: '#5B86FF'
          }).then((result) => {
            if (result.isConfirmed) {
              if (!inpurchase) {
                window.location.href = './user/orders.php';
              } else {
                window.location.href = './receipt.php';
              }
            }
          })
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    }
  }

  function onSubmitGuest() {
    var inpurchase = <?php echo isset($inpurchase) ? $inpurchase : '0' ?>;
    var paymentType = $('input[name=option]:checked').val();
    var name = $('#name').val();
    var cart = <?php echo json_encode($cart) ?>;
    var totalPrice = <?php echo $totalPrice ?>;
    var user_id = '<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : "" ?>';

    if (cart.length === 0) {
      Swal.fire({
        icon: 'warning',
        title: 'Empty Cart',
        text: 'Your cart is empty. Please add items before placing an order.',
        confirmButtonText: 'Okay',
        confirmButtonColor: '#5B86FF'
      });
    } else {
      $.ajax({
        url: './php_function/createOrderGuest.php',
        type: 'POST',
        data: {
          name: name,
          cart: cart,
          totalPrice: totalPrice,
          paymentType: paymentType,
          inpurchase: inpurchase,
        },
        success: function(response) {
          console.log(response);
          Swal.fire({
            icon: 'success',
            title: 'Order Placed!',
            text: 'Your order is successful!',
            confirmButtonText: 'Okay',
            confirmButtonColor: '#5B86FF'
          }).then((result) => {
            if (result.isConfirmed) {
              if (inpurchase) {
                window.location.href = './receipt.php';
              } else {
                window.location.href = './index.php';
              }
            }
          })
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    }
  }

  function onItemDelete(id) {
    $.ajax({
      url: './php_function/cartSession.php?id=' + id,
      type: 'DELETE',
      success: function(response) {
        console.log(response);
        location.reload();
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }

  $('#points').on('input', function() {
    var points = $(this).val();
    var availablePoints = <?php echo isset($points) ? $points : 0 ?>;

    // Check if the entered points exceed the available points
    if (points > availablePoints) {
      $(this).val(availablePoints); // Set the input value to the available points
      points = availablePoints; // Update the points variable
    }

    var totalPrice = <?php echo $totalPrice ?>;

    // Calculate the deducted total based on the input points
    var deductedTotal = totalPrice - (points * 0.05);

    // Update the deducted total on the page
    $('#total').text('RM' + deductedTotal.toFixed(2));
    $('#points_used').text(' (' + points + ' points used)');
  });
</script>