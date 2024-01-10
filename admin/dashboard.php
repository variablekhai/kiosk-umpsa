
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kiosk@UMPSA | Admin</title>
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="../assets/js/init-alpine.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
  <script src="../assets/js/charts-lines.js" defer></script>
  <script src="../assets/js/charts-pie.js" defer></script>
</head>

<body class="poppins">
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Main Body -->
    <div class="flex flex-col flex-1">
      <div class="container px-6 mx-auto grid">
        <h2
          class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
          Dashboard
        </h2>

        <p class="mb-8 text-gray-600 dark:text-gray-400">
          Monitor and analyze kiosk's performance here.
        </p>

        <div class="grid gap-6 mb-8 md:grid-cols-2">
          <!-- Doughnut/Pie chart -->
          <div
            class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
          >
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
              Total Sales Overview by Kiosks
            </h4>
            <canvas id="pie"></canvas>
            <div
              class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400"
            >
              <!-- Chart legend -->
              <div class="flex items-center">
                <span
                  class="inline-block w-3 h-3 mr-1 bg-blue-600 rounded-full"
                ></span>
                <span>Kiosk A</span>
              </div>
              <div class="flex items-center">
                <span
                  class="inline-block w-3 h-3 mr-1 bg-teal-500 rounded-full"
                ></span>
                <span>Kiosk B</span>
              </div>
              <div class="flex items-center">
                <span
                  class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"
                ></span>
                <span>Kiosk C</span>
              </div>
            </div>
          </div>
          <!-- Lines chart -->
          <div
            class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
          >
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
              Total Sales Overview by Month
            </h4>
            </h4>
            <canvas id="line"></canvas>
            <div
              class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400"
            >
              <!-- Chart legend -->
              <div class="flex items-center">
                <span
                  class="inline-block w-3 h-3 mr-1 bg-teal-500 rounded-full"
                ></span>
                <span>Kiosk A</span>
              </div>
              <div class="flex items-center">
                <span
                  class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"
                ></span>
                <span>Kiosk B</span>
              </div>
              <div class="flex items-center">
                <span
                  class="inline-block w-3 h-3 mr-1 bg-orange-500 rounded-full"
                ></span>
                <span>Kiosk C</span>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>