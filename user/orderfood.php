<?php
include '../php_function/authPage.php';
include '../php_function/order.php';

?>
<?php

if(isset($_POST['add_to_cart'])){
$item_name = $_POST['item_name'];
$item_price = $_POST['item_price'];
$item_description = $_POST['item_description'];
$item_kiosk = $_POST['item_kiosk'];
$item_image = $_POST['item_image'];
$item_quantity = $_POST['item_quantity'];

$select_cart = mysqli_query($conn, "SELECT * FROM `Order` WHERE name = '$item_name'") or die('query failed');

if(mysqli_num_rows($select_cart) > 0){
   $message[] = 'product already added to cart!';
}else{
  mysqli_query($conn, "INSERT INTO `Order`(user_id, kiosk_id, name, price, description, quantity) VALUES('$user_id', '$kiosk_id', '$item_name', '$item_price', '$item_description', '$item_quantity')") or die('query failed');
    $message[] = 'product added to cart!';
}

};

if(isset($_POST['update_cart'])){
$update_quantity = $_POST['cart_quantity'];
$update_id = $_POST['cart_id'];
mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
$message[] = 'cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
$remove_id = $_GET['remove'];
mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
header('location:index.php');
}

if(isset($_GET['delete_all'])){
mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
header('location:index.php');
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kiosk@UMPSA | Account</title>
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="../assets/js/init-alpine.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>

  <!-- Flowbite CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
  <link rel="stylesheet" href="style.css">
</head>
<body class="poppins">
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>


<!-- Main Body -->
<!-- Item -->
<div class="menu">

   <h1 class="heading">Choose Food You Want</h1>

   <div class="box-container">

   <?php
      $select_menu = mysqli_query($conn, "SELECT * FROM `Menu`") or die('query failed');
      if(mysqli_num_rows($select_menu) > 0){
         while($fetch_menu = mysqli_fetch_assoc($select_menu)){
   ?>
      <form method="post" class="box" action="">
         <img src="images/<?php echo $fetch_menu['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_menu['name']; ?></div>
         <div class="description"><?php echo $fetch_menu['description']; ?></div>
         <div class="kiosk"><?php echo $fetch_menu['kiosk_id']; ?></div>
         <div class="price">RM<?php echo $fetch_menu['price']; ?>/-</div>
         <input type="number" min="1" name="item_quantity" value="0">
         <input type="hidden" name="item_image" value="<?php echo $fetch_menu['image']; ?>">
         <input type="hidden" name="item_name" value="<?php echo $fetch_menu['name']; ?>">
         <input type="hidden" name="item_price" value="<?php echo $fetch_menu['price']; ?>">
         <input type="hidden" name="item_description" value="<?php echo $fetch_menu['description']; ?>">
         <input type="hidden" name="item_kiosk" value="<?php echo $fetch_menu['kiosk_id']; ?>">
         <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      </form>
   <?php
      };
   };
   ?>

   </div>

</div>

<!-- Main Body -->


































<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>