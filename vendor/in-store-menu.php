<?php
include '../php_function/authPage.php';
include '../php_function/initdb.php';

$show = false;
// get all menu from Menu
$menu_query = "SELECT * FROM Menu";
$menu_result = mysqli_query($conn, $menu_query);

if (!$menu_result) {
  echo "Error fetching menu items: " . mysqli_error($conn);
  exit;
}

$menu = mysqli_fetch_all($menu_result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kiosk@UMPSA | Orders</title>
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="../assets/js/init-alpine.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
  <script src="../assets/js/charts-lines.js" defer></script>
  <script src="../assets/js/charts-pie.js" defer></script>
  <script src="../jquery/jquery-3.7.1.min.js"></script>
</head>

<body class="poppins">
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Sidebar -->
    <?php include('sidebar.php') ?>

    <!-- Main Body -->
    <div class="flex flex-col flex-1 w-full">
      <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Manage In-Store Menu
          </h2>

          <p class="mb-8 text-gray-600 dark:text-gray-400">
            Manage, organize, and update in-store menu for your kiosk.
          </p>

          <!-- Users Table -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Description</th>
                    <th class="px-4 py-3">Stock</th>
                    <th class="px-4 py-3">Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y">
                  <?php
                  foreach ($menu as $menu_item) {
                    // check if menu is in In-Store Menu
                    try {
                      $in_store_query = "SELECT * FROM InPurchaseMenu WHERE menu_id = '" . $menu_item['menu_id'] . "'";
                      $in_store_result = mysqli_query($conn, $in_store_query);
                      $in_store = mysqli_fetch_assoc($in_store_result);

                      if ($in_store != null) {
                        $show = true;
                      } else {
                        $show = false;
                      }
                    } catch (Exception $e) {
                      echo "Error: " . $e->getMessage();
                    }
                  ?>
                    <tr class="text-gray-700">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <!-- Avatar with inset shadow -->
                          <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                            <img class="object-cover w-full h-full rounded-full" src="<?php echo $menu_item['image']; ?>" alt="" loading="lazy" />
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                          </div>
                          <div>
                            <p class="font-semibold"><?php echo $menu_item['name']; ?></p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm"><?php echo $menu_item['description']; ?></td>
                      <td class="px-4 py-3 text-xs">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                          <?php echo $menu_item['quantity_remaining']; ?>
                      </td>
                      </span>
                      <td class="px-4 py-3">
                        <!-- Actions -->
                        <div class="flex items-center space-x-4 text-sm">
                          <?php if ($show) { ?>
                            <button onclick="toggleMenu('<?php echo $menu_item['menu_id'] ?>')" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-primary rounded-lg" aria-label="Don't show">
                              <i class="fa-solid fa-eye"></i>
                            </button>
                          <?php } else { ?>
                            <button onclick="toggleMenu('<?php echo $menu_item['menu_id'] ?>')" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-primary rounded-lg" aria-label="Show">
                              <i class="fa-solid fa-eye-slash"></i>
                            </button>
                          <?php } ?>
                        </div>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
              <?php
              $menuCount = count($menu);
              ?>
              <span class="flex items-center col-span-3">
                Showing <?php echo $menuCount; ?> of <?php echo $menuCount; ?>
              </span>
              <span class="col-span-2"></span>
              <!-- Pagination -->
              <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                  <ul class="inline-flex items-center">
                    <li>
                      <button class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                          <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                      </button>
                    </li>
                    <li>
                      <button class="px-3 py-1 text-white transition-colors duration-150 bg-primary border border-r-0 rounded-md">
                        1
                      </button>
                    </li>
                    <li>
                      <button class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                          <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                      </button>
                    </li>
                  </ul>
                </nav>
              </span>
            </div>
          </div>
        </div>
      </main>
    </div>

  </div>
</body>

</html>

<script>
  function toggleMenu(menuId) {
    $.ajax({
      url: './functions/toggle-menu.php',
      method: 'POST',
      data: { menu_id: menuId },
      success: function(response) {
        location.reload();
        console.log(response);
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }
</script>