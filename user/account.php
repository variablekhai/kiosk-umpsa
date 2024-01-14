<?php
include '../php_function/initdb.php';
include '../php_function/authPage.php';
include '../php_function/generateQR.php';
session_start();

// Get all user's data from session
$id = $_SESSION['id'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$userName = $_SESSION['name'];
$userType = $_SESSION['type'];
$userImage = $_SESSION['image'];

if ($userImage == null) {
  $userImage = "https://linguistics.ucla.edu/wp-content/uploads/2020/06/placeholder-300x248.jpg";
}

// Get membership points based on user
$points_sql = "SELECT * FROM User u JOIN Membership m ON u.membership_id = m.membership_id WHERE u.user_id = '$id'";

$points_result = mysqli_query($conn, $points_sql);

if (!$points_result) {
  // Handle the error
  die("Error: " . mysqli_error($conn));
}

if(mysqli_num_rows($points_result) > 0) {
  $points_row = mysqli_fetch_assoc($points_result);
  $points = $points_row["membership_point"];
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
  <script src="../jquery/jquery-3.7.1.min.js"></script>

</head>

<body class="poppins">
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>

    <!-- Main Body -->
    <div class="flex flex-col flex-1 w-full">
      <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">
          
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Account
          </h2>

          <p class="mb-8 text-gray-600 dark:text-gray-400">
            View, and update your account.
          </p>

          <div class="w-full grid grid-cols-2">
            <div class="col-span-1">
              <div class="flex flex-col items-center">
                  <img src="<?php echo $userImage; ?>" style="object-fit: cover; width: 12rem; height: 12rem;" class="rounded-full" />
                <div class="mt-2">
                  <span
                    class="text-[#5B86FF] bg-primary-light border border-primary rounded-full text-primary text-sm poppins px-4 py-1 inline-block mb-4 ">
                    <?php echo $userType; ?>
                  </span>
                  <span
                    class="text-[#5B86FF] bg-primary-light border border-primary rounded-full text-primary text-sm poppins px-4 py-1 inline-block mb-4 ">
                    <?php echo $points; ?>
                    points</span>
                </div>
              </div>
            </div>
            <div class="flex justify-center">
              <div>
                <form id="updateForm" class="w-full flex flex-col space-y-4">
                  <input id="id" name="id" class="hidden" value="<?php echo $id; ?>" />
                  <img id="userqr" class="w-64 h-64" src="">
                  <input id="name" name="name" placeholder="Name"
                    value="<?php echo $userName; ?>"
                    class="w-full px-4 py-3 rounded-lg ring-[#abc1ff] focus:ring-4 focus:outline-none transition duration-300 border border-gray-300 focus:shadow-xl">

                  <input id="email" name="email" placeholder="Email" disabled
                    value="<?php echo $email; ?>"
                    class="w-full px-4 py-3 rounded-lg ring-[#abc1ff] focus:ring-4 focus:outline-none transition duration-300 border border-gray-300 focus:shadow-xl">

                  <input id="password" name="password" placeholder="Password"
                    value="<?php echo $password; ?>"
                    class="w-full px-4 py-3 rounded-lg ring-[#abc1ff] focus:ring-4 focus:outline-none transition duration-300 border border-gray-300 focus:shadow-xl">

                  <input id="image" name="image" placeholder="Image Link"
                    value="<?php echo $userImage; ?>"
                    class="w-full px-4 py-3 rounded-lg ring-[#abc1ff] focus:ring-4 focus:outline-none transition duration-300 border border-gray-300 focus:shadow-xl">

                  <span id="errorMsg" style="color: #FF6B6B;" class="hidden">Fill in all fields</span>
                  
                  <button
                    id="updateBtn"
                    class="w-full py-3 bg-primary text-white ring-[#abc1ff] focus:outline-none focus:ring-4 mt-6 rounded-lg transition duration-300 poppins">Update</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
    </main>
  </div>

  </div>
</body>

</html>
<script>

  // $.document.ready(function() {
  //     $.ajax({
  //       type: "POST",
  //       url: "../php_function/generate_qr.php",
  //       data: {
  //           id: <?php echo $id ?>
  //       },
  //       success: function(data) {
  //         console.log(data)
  //           // $('#qr-modal').html(`
  //           //     <div class="flex flex-col items-center justify-center">
  //           //         <img class="w-40 h-40" src="${data}" alt="User QR Code">
  //           //     </div>
  //           // `);
  //       }
  //     });
  //   })

  $(document).ready(function() {
    var userID = '<?php echo $id; ?>';
    $.ajax({
      type: "POST",
      url: "../php_function/generate_qr.php",
      data: {
        id: userID
      },
      success: function(data) {
        $('#userqr').attr("src",data);
      }
    });      
  });

  $("#updateBtn").click(function(e) {
    e.preventDefault();
    var id = $("#id").val()
    var name = $("#name").val()
    var password = $("#password").val()
    var image = $("#image").val()
    
    $("#errorMsg").hide()

    if (name.length > 0 && password.length > 0 && image.length > 0) {
      var formData = $("#updateForm").serialize();
      console.log(formData)
      $.post("../php_function/updateAccountProcess.php", formData, function(result) {

        try {
          result = $.parseJSON(result)
        } catch (e) {
          console.log(e)
        }
        console.log("result", result)
        if (result[0] == 'true') {
          location.reload()
        }
      });
    }
    else {
      $("#errorMsg").show()
    }
    
  });
</script>