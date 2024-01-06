<?php
  $page = basename($_SERVER['PHP_SELF']);

  
?> 
<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
      <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
          Kiosk@UMPSA
        </a>
        <ul class="mt-6">
          <li class="relative px-6 py-3">
            <?php
            if($page == 'dashboard.php') {
              echo '<span class="absolute inset-y-0 left-0 w-1 bg-primary rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>';
            } 
            ?>
            <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
              href="dashboard">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
              </svg>
              <span class="ml-4">Dashboard</span>
            </a>
          </li>
        </ul>
        <ul>
          <li class="relative px-6 py-3">
            <?php
            if($page == 'menu.php') {
              echo '<span class="absolute inset-y-0 left-0 w-1 bg-primary rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>';
            } 
            ?>
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              href="menu">
              <i class="fa-solid fa-utensils"></i>
              <span class="ml-4">Manage Menu</span>
            </a>
          </li>
        </ul>
        <ul>
          <ul>
            <li class="relative px-6 py-3">
              <?php
              if($page == 'orders.php') {
                echo '<span class="absolute inset-y-0 left-0 w-1 bg-primary rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>';
              } 
              ?>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="orders">
                <i class="fa-solid fa-list"></i>
                <span class="ml-4">Orders</span>
              </a>
            </li>
          </ul>
          <ul>
            <li class="relative px-6 py-3">
            <?php
            if($page == 'in-store-menu.php') {
              echo '<span class="absolute inset-y-0 left-0 w-1 bg-primary rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>';
            } 
            ?>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="in-store-menu">
                <i class="fa-solid fa-utensils"></i>
                <span class="ml-4">In-Store Menu</span>
              </a>
            </li>
          </ul>
          <ul>
            <li class="relative px-6 py-3">
              <?php
              if($page == 'in-store.php') {
                echo '<span class="absolute inset-y-0 left-0 w-1 bg-primary rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>';
              } 
              ?>
              <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="in-store">
                <i class="fa-solid fa-store"></i>
                <span class="ml-4">In-Store Page</span>
              </a>
            </li>
          </ul>
          <div class="px-6 my-6">
            <button id="btnLogout" onclick="location.href = '../php_function/logoutProcess.php'"
              class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary border border-transparent rounded-full focus:outline-none">
              Logout
              <span class="ml-2" aria-hidden="true"><i class="fa-solid fa-right-from-bracket"
                  style="color: #ffffff;"></i></span>
            </button>
          </div>
      </div>
  </aside>