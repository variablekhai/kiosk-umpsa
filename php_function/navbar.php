<?php
session_start();
if (isset($_SESSION['name']) && isset($_SESSION['email'])) {
    $name = $_SESSION['name'];
    $image = $_SESSION['image'];
    $user_type = $_SESSION['type'];

    if ($user_type == 'Vendor') {
      $dashboardUrl = './vendor/dashboard';
    } else if ($user_type == 'User') {
      $dashboardUrl = './user/dashboard';
    } else if ($user_type == 'Admin') {
      $dashboardUrl = './admin/dashboard';
    } else {
      $dashboardUrl = '#';
    }

    if ($image == null) {
        $image = "https://linguistics.ucla.edu/wp-content/uploads/2020/06/placeholder-300x248.jpg";
    }

    echo <<<HTML
    <!-- Start Navbar -->
    <header class="bg-transparent bg-transparent fixed z-50 top-0 left-0 w-full transition duration-500">
        <nav class="flex items-center max-w-screen-xl mx-auto px-6 py-3">
          <!-- Left Side -->
          <div class="flex flex-grow" style="cursor: pointer;" onclick="location.href='/kiosk-umpsa/'">
            Kiosk@UMPSA
          </div>
          <!-- Right Side -->
          <div class="flex items-center justify-end space-x-6">
            <div class="relative">
              <div class="rounded-full overflow-hidden">
                <img class="w-10 h-10 object-cover" src="$image" alt="Profile image" onclick="toggleDropdown()">
              </div>
              <div id="dropdown" class="absolute right-0 mt-3 w-48 bg-white rounded-md shadow-lg hidden">
                <ul class="py-2">
                  <div class="p-2 px-3">
                    <li><a href='$dashboardUrl'>Dashboard</a></li>
                    <li><a href='php_function/logoutProcess.php'>Sign Out</a></li>
                  </div> 
                </ul>
              </div>
            </div>
            <div class="ml-2">
              $name
            </div>
          </div>
        </nav>
    </header>
    <!-- End Navbar -->
    <script>
      function toggleDropdown() {
        var dropdown = document.getElementById("dropdown");
        dropdown.classList.toggle("hidden");
      }

      
    </script>
    HTML;
} else {
    echo <<<HTML
    <!-- Start Navbar -->
    <header class="bg-transparent bg-transparent fixed z-50 top-0 left-0 w-full transition duration-500">
        <nav class="flex items-center max-w-screen-xl mx-auto px-6 py-3">
          <!-- Left Side -->
          <div class="flex flex-grow" style="cursor: pointer;" onclick="location.href='/kiosk-umpsa/'">
            Kiosk@UMPSA
          </div>
          <!-- Right Side -->
          <div class="flex items-center justify-end space-x-6">
            <button><a href="signin">Sign In</a></button>
            <button class="bg-[#5B86FF] px-6 py-3 text-white poppins rounded-full ring-[#abc1ff] focus:outline-none focus:ring-4 transform transition duration-700 hover:scale-105" onclick="location.href='signup'">Sign Up</button>
          </div>
        </nav>
    </header>
    <!-- End Navbar -->
    HTML;
}
?>