<?php
echo <<<HTML
<!-- Start Navbar -->
<header class="bg-transparent bg-transparent fixed z-50 top-0 left-0 w-full transition duration-500">
    <nav class="flex items-center max-w-screen-xl mx-auto px-6 py-3">
      <!-- Left Side -->
      <div class="flex flex-grow" style="cursor: pointer;" onclick="location.href=\'index\'">
        Kiosk@UMPSA
      </div>
      <!-- Right Side -->
      <div class="flex items-center justify-end space-x-6">
        <button><a href="signin">Sign In</a></button>
        <button
          class="bg-[#5B86FF] px-6 py-3 text-white poppins rounded-full ring-[#abc1ff] focus:outline-none focus:ring-4 transform transition duration-700 hover:scale-    105" onclick="location.href=\'signup\'">Sign
          Up</button>
      </div>
    </nav>
</header>
<!-- End Navbar -->
HTML;
?>