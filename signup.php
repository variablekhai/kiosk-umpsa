<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include 'php_function/head.php'; ?>
  <title>Kiosk@UMPSA | Sign Up</title>
  <script>
    $(document).ready(function() {
      $("#errorMsg").hide();
      $("#btnSignUp").prop("disabled",true);
      $("#name").change(function(e) {
        validateSignin()
      })
      $("#email").change(function(e) {
        validateSignin()
      })
      $("#password").change(function(e) {
        validateSignin()
      })
    })
    function validateSignin() {
      var email = $("#email").val();
      var pwd = $("#password").val();
      var name = $("#name").val();
      if (name.length == 0 || pwd.length < 6 || !validateEmail(email)) {
        $("#errorMsg").show();
        $("#btnSignUp").prop("disabled",true);
      }
      else {
        $("#errorMsg").hide();
        $("#btnSignUp").prop("disabled",false);
      }
    }
    function validateEmail(email) {
      return String(email)
        .toLowerCase()
        .match(
          /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    }
  </script>
</head>

<body class="">

  <?php include 'php_function/navbar.php'; ?>

  <!-- Start Main Body -->
  <main class="h-screen w-full banner">
    <div class="flex flex-col justify-center items-center h-screen">
      <!-- To be replaced with logo -->
      <div>
        <a>Kiosk@UMPSA</a>
      </div>
      <form id="signUp" class="bg-white w-96 mt-6 p-4 rounded-lg shadow-lg">
        <div class="flex flex-col space-y-6">

          <input id="name" placeholder="Name" name="name" type="text"
            class="w-full px-4 py-3 rounded-lg ring-[#abc1ff] focus:ring-4 focus:outline-none transition duration-300 border border-gray-300 focus:shadow-xl" required>

          <input id="email" placeholder="Email" name="email" type="email"
            class="w-full px-4 py-3 rounded-lg ring-[#abc1ff] focus:ring-4 focus:outline-none transition duration-300 border border-gray-300 focus:shadow-xl" required>

          <input id="password" placeholder="Password" name="password" type="password"
            class="w-full px-4 py-3 rounded-lg ring-[#abc1ff] focus:ring-4 focus:outline-none transition duration-300 border border-gray-300 focus:shadow-xl" required>

          <!-- Todo: Change this sucky select -->
          <main class="grid w-full place-items-center">
              <div class="grid w-full grid-cols-2 gap-2 rounded-lg p-2 border border-gray-300">
                  <div>
                      <input type="radio" name="type" id="1" value="Student" class="peer hidden" checked />
                      <label for="1" class="block cursor-pointer select-none rounded-lg p-1 text-center peer-checked:bg-[#5B86FF] peer-checked:font-medium peer-checked:text-white">Student</label>
                  </div>

                  <div>
                      <input type="radio" name="type" id="2" value="Vendor" class="peer hidden" />
                      <label for="2" class="block cursor-pointer select-none rounded-lg p-1 text-center peer-checked:bg-[#5B86FF] peer-checked:font-medium peer-checked:text-white">Vendor</label>
                  </div>
              </div>
          </main>

          <span id="errorMsg" class="text-[#FF6B6B]">Invalid email address or password must at least 6 characters</span>

          <button id="btnSignUp"
            class="w-full py-3 bg-[#5B86FF] text-white ring-[#abc1ff] focus:outline-none focus:ring-4 mt-6 rounded-lg transition duration-300 poppins">Sign
            Up</button>

          <p class="text-gray-400 text-center"><span style="font-family: sans-serif;">———</span> Already have an account? <span style="font-family: sans-serif;">———</span></p>

          <button type="button" onclick="window.location.href='signin.php'"
            class="w-full py-3 border border-[#5B86FF] bg-white text-[#5B86FF] ring-[#abc1ff] focus:outline-none focus:ring-4 mt-6 rounded-lg transition duration-300 poppins">Sign
            In</button>
        </div>
      </form>
    </div>
    </div>
  </main>
  <!-- End Main Body -->

</body>

</html>
<script>
$("#btnSignUp").click(function(e) {
  e.preventDefault();

  var formData = $("#signUp").serialize();
  console.log("form data", formData)
  $.post("php_function/signupProcess.php", formData, function(result) {
    if (result == 'true') {
      location.href = "signin"
    }
    console.log(result)
  });
});
</script>
<script src="script.js"></script>