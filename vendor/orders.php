<?php
include '../php_function/authPage.php';
include '../php_function/initdb.php';
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

  <!-- Flow Bite Link And Jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
  <script src="../jquery/jquery-3.7.1.min.js"></script>
</head>

<body class="poppins">
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Sidebar -->
    <?php 
    include('sidebar.php');
    include './components/edit-order-modal.php';
    include './components/delete-order-modal.php';
     ?>

    <!-- Main Body -->
    <div class="flex flex-col flex-1 w-full">
      <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">
          <h2
            class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
          >
            Orders
          </h2>

          <p class="mb-8 text-gray-600 dark:text-gray-400">
            View, and update orders made by students.
          </p>

          <!-- Users Table -->
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50"
                  >
                    <th class="px-4 py-3">Order</th>
                    <th class="px-4 py-3">Quantity</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Time Created</th>
                    <th class="px-4 py-3">Actions</th>
                  </tr>
                </thead>
                <tbody
                  class="bg-white divide-y"
                >
                <!-- Order list based on order item-->
                <?php
                
                $sql = "SELECT oi.id, o.name AS user, m.name, m.image, oi.quantity, o.total, o.status, o.date_created FROM OrderItem oi INNER JOIN Menu m INNER JOIN `Order` o
                          ON oi.menu_id = m.menu_id AND oi.order_id = o.order_id
                            WHERE oi.kiosk_id = ".$_SESSION['kiosk_id']." AND o.status != 'Cancelled';";
                
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result)){
                ?>

                  <tr class="text-gray-700">
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <!-- Avatar with inset shadow -->
                        <div
                          class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                        >
                          <img
                            class="object-cover w-full h-full rounded-full"
                            src="<?php echo $row['image']; ?>"
                            alt=""
                            loading="lazy"
                          />
                          <div
                            class="absolute inset-0 rounded-full shadow-inner"
                            aria-hidden="true"
                          ></div>
                        </div>
                        <div>
                          <p class="font-semibold"><?php echo $row['name']; ?></p>
                          <p class="text-xs text-gray-600 dark:text-gray-400">
                            <?php echo $row['user']; ?>
                          </p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                    <?php echo $row['quantity']; ?> 
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <?php echo "RM " . $row['total']; ?>
                    </td>
                    <td class="px-4 py-3 text-xs">
                      <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                      >
                      <?php echo $row['status']; ?>
                      </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <?php echo $row['date_created']; ?>
                    </td>
                    <td class="px-4 py-3">
                      <div class="flex items-center space-x-4 text-sm">
                        <button
                          data-modal-target="edit-order-modal" data-model-toggle="edit-order-modal" data-order-id="<?php echo $row['id']; ?>"
                          class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-primary rounded-lg"
                          aria-label="Edit"
                        >
                          <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                          >
                            <path
                              d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                            ></path>
                          </svg>
                        </button>
                        <button
                          data-modal-target="delete-order-modal" data-model-toggle="delete-order-modal" data-order-id="<?php echo $row['id']; ?>"
                          class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-primary rounded-lg"
                          aria-label="Delete"
                        >
                          <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                          >
                            <path
                              fill-rule="evenodd"
                              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                              clip-rule="evenodd"
                            ></path>
                          </svg>
                        </button>
                      </div>
                    </td>
                  </tr>

                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>


            <!-- Pagination start here -->
            <div
              class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
            >
              <span class="flex items-center col-span-3">
                Showing 2 of 2
              </span>
              <span class="col-span-2"></span>
              <!-- Pagination -->
              <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                  <ul class="inline-flex items-center">
                    <li>
                      <button
                        class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                        aria-label="Previous"
                      >
                        <svg
                          class="w-4 h-4 fill-current"
                          aria-hidden="true"
                          viewBox="0 0 20 20"
                        >
                          <path
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd"
                            fill-rule="evenodd"
                          ></path>
                        </svg>
                      </button>
                    </li>
                    <li>
                      <button
                        class="px-3 py-1 text-white transition-colors duration-150 bg-primary border border-r-0 rounded-md"
                      >
                        1
                      </button>
                    </li>
                    <!-- <li>
                      <button
                        class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                      >
                        2
                      </button>
                    </li> -->
                    <li>
                      <button
                        class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                        aria-label="Next"
                      >
                        <svg
                          class="w-4 h-4 fill-current"
                          aria-hidden="true"
                          viewBox="0 0 20 20"
                        >
                          <path
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"
                            fill-rule="evenodd"
                          ></path>
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
  $("button[data-modal-target='edi-order-modal']").click(function() {
    var orderId = $(this).data('order-id');
    $("#edit-order-modal").data('order-id', orderId);
  });
</script>