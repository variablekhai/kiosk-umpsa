<?php
include '../php_function/initdb.php';

// Fetch users from the database
$user_query = "SELECT * FROM User";
$result = mysqli_query($conn, $user_query);

// Initialize an empty array to store users
$users = [];

// Check if there are any users
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    // Add user information to the array
    $users[] = $row;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kiosk@UMPSA | User Management</title>
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="../assets/js/init-alpine.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
  <script src="../jquery/jquery-3.7.1.min.js"></script>
</head>

<body class="poppins">
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">

    <?php
    include 'sidebar.php';
    include './components/add-user-modal.php';
    include './components/edit-user-modal.php';
    include './components/delete-user-modal.php';
    include './components/approve-user-modal.php';
    include './components/qr-modal.php';
    ?>
    <!-- Main Body -->
    <div class="flex flex-col flex-1 w-full">
      <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">
          <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            User Management
          </h2>

          <p class="mb-8 text-gray-600 dark:text-gray-400">
            Manage, organize users, and update user information.
          </p>

          <!-- Users Table -->
          <div class="flex justify-end mb-2">
            <button data-modal-target="add-user-modal" data-modal-toggle="add-user-modal" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary border border-transparent rounded-md focus:outline-none">
              Add new user
              <span class="ml-2" aria-hidden="true"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></span>
            </button>
          </div>
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Date Created</th>
                    <th class="px-4 py-3">Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y">
                  <?php
                  $vendorStatus = ''; // Declare and initialize the variable

                  foreach ($users as $user) :
                    if ($user['user_type'] === 'Vendor') {
                      // Retrieve the status from the Vendor table using the user_id
                      $id = $user['user_id'];
                      $status_query = "SELECT * FROM Vendor WHERE user_id = '$id'";
                      $result = mysqli_query($conn, $status_query);

                      if ($result) {
                        if ($row = mysqli_fetch_assoc($result)) {
                          $vendorStatus = $row['status'];
                        }
                      } else {
                        // Handle query error
                        echo "Error: " . mysqli_error($conn);
                      }
                    }
                  ?>
                    <tr class="text-gray-700">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                            <img class="object-cover w-full h-full rounded-full" src="<?= $user['image'] ?? 'https://linguistics.ucla.edu/wp-content/uploads/2020/06/placeholder-300x248.jpg' ?>" alt="" loading="lazy" />
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                          </div>
                          <div>
                            <p class="font-semibold"><?= $user['name'] ?></p>
                            <p class="text-xs text-gray-600 dark:text-gray-400"><?= $user['user_type'] ?></p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm"><?= $user['email'] ?></td>
                      <td class="px-4 py-3 text-xs">
                        <?=
                        $user['user_type'] == 'Vendor' ?
                          ($vendorStatus == 'Pending' ?
                            '<span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">Pending</span>' :
                            '<span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Approved</span>') : ('<span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Approved</span>')
                        ?>
                      </td>
                      <td class="px-4 py-3 text-sm"><?= $user['date_created'] ?></td>
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                          <button data-user-id="<?= $user['user_id'] ?>" data-modal-target="qr-modal" data-modal-toggle="qr-modal" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-primary rounded-lg" aria-label="Qr Code">
                            <i class="fa-solid fa-qrcode"></i>
                          </button>
                          <button data-user-id="<?= $user['user_id'] ?>" data-modal-target="edit-user-modal" data-modal-toggle="edit-user-modal" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-primary rounded-lg" aria-label="Edit" type="">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                          </button>
                          <button data-user-id="<?= $user['user_id'] ?>" data-modal-target="delete-user-modal" data-modal-toggle="delete-user-modal" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-primary rounded-lg" aria-label="Delete">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                          <?php
                          if ($user['user_type'] === 'Vendor') {
                            if ($vendorStatus === 'Pending') {
                              echo '<button
                          data-user-id="' . $user['user_id'] . '"
                          data-modal-target="approve-user-modal"
                          data-modal-toggle="approve-user-modal" 
                          class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-primary rounded-lg"
                          aria-label="Approve"
                          > 
                            <i class="fa-solid fa-check" style="color: #5B86FF;"></i>
                        </button>';
                            }
                          }
                          ?>
                        </div>
                      </td>
                    </tr>
                  <?php
                  endforeach;
                  ?>
                </tbody>
              </table>
            </div>
            <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
              <span class="flex items-center col-span-3">
                Showing <?= count($users) ?> of <?= count($users) ?>
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
  $("button[data-modal-target='edit-user-modal']").click(function() {
    var userId = $(this).data('user-id');
    $("#edit-user-modal").data('user-id', userId);
  });
</script>