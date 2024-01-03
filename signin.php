<!DOCTYPE html>
<html lang="en">
<?php 
include 'php_function/initdb.php';

if (isset($_SESSION['email'])) {
  header("Location: index.php");
  exit();
}
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include 'php_function/head.php'; ?>
  <title>Kiosk@UMPSA | Sign In</title>
</head>
<script>
$(document).ready(function() {
  $("#errorMsg").hide()
  $("#invalidMsg").hide()
})
</script>
<body>

  <?php include 'php_function/navbar.php'; ?>

  <!-- Start Main Body -->
  <main class="h-screen w-full banner">
    <div class="flex flex-col justify-center items-center h-screen">
      <!-- To be replaced with logo -->
      <div>
        <a>Kiosk@UMPSA</a>
      </div>
      <form class="bg-white w-96 mt-6 p-4 rounded-lg shadow-lg" id="signIn">
        <div class="flex flex-col space-y-6">

          <input id="email" placeholder="Email" name="email"
            class="w-full px-4 py-3 rounded-lg ring-[#abc1ff] focus:ring-4 focus:outline-none transition duration-300 border border-gray-300 focus:shadow-xl">
          
          <input id="password" placeholder="Password" name="password"
            class="w-full px-4 py-3 rounded-lg ring-[#abc1ff] focus:ring-4 focus:outline-none transition duration-300 border border-gray-300 focus:shadow-xl">

          <span id="errorMsg" class="text-[#FF6B6B]">Insert email and password</span>
          <span id="invalidMsg" class="text-[#FF6B6B]">Invalid email or password</span>

          <button id="btnSignIn"
            class="w-full py-3 bg-[#5B86FF] text-white ring-[#abc1ff] focus:outline-none focus:ring-4 mt-6 rounded-lg transition duration-300 poppins">Sign
            In</button>

          <p class="text-gray-400 text-center"><span style="font-family: sans-serif;">———</span> Don't have an account? <span style="font-family: sans-serif;">———</span></p>

          <button
            type="button"
            onclick="window.location.href='signup'"
            class="w-full py-3 border border-[#5B86FF] bg-white text-[#5B86FF] ring-[#abc1ff] focus:outline-none focus:ring-4 mt-6 rounded-lg transition duration-300 poppins">Sign
            Up</button>
        </div>
      </form>
    </div>
    </div>
  </main>
  <!-- End Main Body -->

</body>

</html>
<script>
$("#btnSignIn").click(function(e) {
  e.preventDefault();
  var email = $("#email").val()
  var password = $("#password").val()
  
  $("#invalidMsg").hide()
  $("#errorMsg").hide()

  if (email.length > 0 && password.length > 0) {
    var formData = $("#signIn").serialize();
    $.post("php_function/signinProcess.php", formData, function(result) {
      result = $.parseJSON(result)
      console.log(result)
      if (result[0] == 'true') {
        if (result[1] == 'User') location.href = "index"
        if (result[1] == 'Vendor') location.href = "index"
        if (result[1] == 'Admin') location.href = "admin/dashboard"
      }
      else {
        $("#invalidMsg").show()
      }
    });
  }
  else {
    $("#errorMsg").show()
  }
  
});
</script>
<script src="script.js"></script>