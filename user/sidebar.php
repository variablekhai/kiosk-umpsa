<?php
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
$url = "https://";   
else  
$url = "http://";   

// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];   
// Append the requested resource location to the URL   
$url.= $_SERVER['REQUEST_URI'];
if (str_contains($url, "account")) {
    echo <<<HTML
        <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
        <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
            Kiosk@UMPSA
        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 "
                href="dashboard.php">
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
            <span class="absolute inset-y-0 left-0 w-1 bg-primary rounded-tr-lg rounded-br-lg"
                aria-hidden="true"></span>
            <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="account.php">
                <i class="fa-regular fa-user"></i>
                <span class="ml-4">Account</span>
            </a>
            </li>
        </ul>
        <ul>
            <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="orders.php">
                <i class="fa-solid fa-list"></i>
                <span class="ml-4">My Orders</span>
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
    HTML;
}
if (str_contains($url, "dashboard")) {
    echo <<<HTML
        <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
      <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
          Kiosk@UMPSA
        </a>
        <ul class="mt-6">
          <li class="relative px-6 py-3">
            <span class="absolute inset-y-0 left-0 w-1 bg-primary rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
            <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
              href="dashboard.php">
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
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              href="account.php">
              <i class="fa-regular fa-user"></i>
              <span class="ml-4">Account</span>
            </a>
          </li>
        </ul>
        <ul>
          <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              href="orders.php">
              <i class="fa-solid fa-list"></i>
              <span class="ml-4">My Orders</span>
            </a>
          </li>
        </ul>
        <div class="px-6 my-6">
          <button id="btnLogout" onclick="location.href = '../php_function/logoutProcess.php'"
            class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary border border-transparent rounded-full focus:outline-none">
            Logout
            <span class="ml-2" aria-hidden="true"><i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i></span>
          </button>
        </div>
      </div>
    </aside>
    HTML;
}
if (str_contains($url, "orders")) {
    echo <<<HTML
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
      <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
          Kiosk@UMPSA
        </a>
        <ul class="mt-6">
          <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
              href="dashboard.php">
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
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              href="account.php">
              <i class="fa-regular fa-user"></i>
              <span class="ml-4">Account</span>
            </a>
          </li>
        </ul>
        <ul>
          <li class="relative px-6 py-3">
            <span class="absolute inset-y-0 left-0 w-1 bg-primary rounded-tr-lg rounded-br-lg"
              aria-hidden="true"></span>
            <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
              href="orders.php">
              <i class="fa-solid fa-list"></i>
              <span class="ml-4">My Orders</span>
            </a>
          </li>
        </ul>
        <div class="px-6 my-6">
          <button id="btnLogout" onclick="location.href = '../  php_function/logoutProcess.php'"
            class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary border border-transparent rounded-full focus:outline-none">
            Logout
            <span class="ml-2" aria-hidden="true"><i class="fa-solid fa-right-from-bracket"
                style="color: #ffffff;"></i></span>
          </button>
        </div>
      </div>
    </aside>
    HTML;
}
?>
