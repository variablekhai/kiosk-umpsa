<?php 
include('../php_function/authPage.php');
include '../php_function/initdb.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kiosk@UMPSA | Vendor</title>
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="../assets/js/init-alpine.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
  <!-- <script src="../assets/js/charts-lines.js" defer></script>
  <script src="../assets/js/charts-pie.js" defer></script> -->
  <script src="../jquery/jquery-3.7.1.min.js"></script>
  <script>
    
  </script>
</head>

<body class="poppins">
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    <!-- Sidebar -->
    <?php include('sidebar.php') ?>

    <!-- Main Body -->
    <div class="flex flex-col flex-1">
      <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
          Dashboard
        </h2>

        <p class="mb-8 text-gray-600 dark:text-gray-400">
          Monitor and analyze Kiosk A performance here.
        </p>

        <div class="grid gap-6 mb-8 md:grid-cols-2">
          <!-- Doughnut/Pie chart -->
          <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
              Total Sales by Food
            </h4>
            <canvas id="pie"></canvas>
            <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
              <!-- Chart legend -->
              <!-- <div class="flex items-center">
                <span class="inline-block w-3 h-3 mr-1 bg-blue-600 rounded-full"></span>
                <span>Nasi Ayam</span>
              </div>
              <div class="flex items-center">
                <span class="inline-block w-3 h-3 mr-1 bg-teal-500 rounded-full"></span>
                <span>Waffle</span>
              </div>
              <div class="flex items-center">
                <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                <span>Nasi Lemak</span>
              </div> -->
            </div>
          </div>
          <!-- Lines chart -->
          <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
              Total Sales Overview by Month
            </h4>
            </h4>
            <canvas id="line"></canvas>
            <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
              <!-- Chart legend -->
              <!-- <div class="flex items-center">
                <span class="inline-block w-3 h-3 mr-1 bg-orange-500 rounded-full"></span>
                <span>Kiosk C</span>
              </div> -->
            </div>
          </div>
        </div>

        <!-- Table for List Payment -->
        <div class="grid mb-8 md:grid-cols-1">
          <div class="w-full p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <table id="payment_dt" class="w-full whitespace-no-wrap">
              <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Quantity</th>
                    <th class="px-4 py-3">Payment</th>
                    <th class="px-4 py-3">Date</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $paymentsql = "SELECT * FROM Payment p INNER JOIN `Order` o INNER JOIN OrderItem oi 
                              ON p.order_id = o.order_id AND o.order_id = oi.order_id 
                                WHERE o.status = 'Completed' AND oi.kiosk_id = ".$_SESSION['kiosk_id'];
              $payres = mysqli_query($conn, $paymentsql);
              if(mysqli_num_rows($payres)){
                while($row=mysqli_fetch_assoc($payres)){
              ?>
              <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                <td class="px-4 py-3"><?php echo $row['name'] ?></td>
                <td class="px-4 py-3"><?php echo $row['amount'] ?></td>
                <td class="px-4 py-3"><?php echo $row['quantity'] ?></td>
                <td class="px-4 py-3"><?php echo $row['payment_type'] ?></td>
                <td class="px-4 py-3"><?php echo $row['date_created'] ?></td>
              </tr>
              <?php
                }
              }
              ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
  </div>
  <script>

    //Button Logout
    $("#btnLogout").click(function(e){
      e.preventDefault();
      $.post("../php_function/logoutProcess.php", '', function(result){
        if(result == 'true') {
          location.href = "/kiosk-umpsa/"
        }
      })
    })

    //Fetch data
    <?php
    
    $id = $_SESSION['id'];

    $query = "SELECT 
    YEAR(o.`date_created`) AS order_year,
    MONTHNAME(o.`date_created`) AS order_month,
    SUM(p.`amount`) AS total_amount
    FROM 
        `Payment` p
    INNER JOIN 
        `Order` o ON p.`order_id` = o.`order_id`
    INNER JOIN 
        `OrderItem` oi ON oi.`order_id` = o.`order_id`
    INNER JOIN 
        `Menu` m ON oi.`menu_id` = m.`menu_id`
    INNER JOIN 
        `Kiosk` k ON m.`kiosk_id` = k.`kiosk_id`
    INNER JOIN 
        `Vendor` v ON k.`kiosk_id` = v.`kiosk_id`
    WHERE 
        v.`user_id` = '$id'
    GROUP BY 
    YEAR(o.`date_created`), MONTH(o.`date_created`)";

    $result = mysqli_query($conn, $query);

    $sums = [];
    while($row = mysqli_fetch_assoc($result)) {
      $sums[] = $row;
    }
    
    $count = 1;
    $monthStr = "";
    $amt = "";
    foreach($sums as $sum) {
      $monthStr = $monthStr."'".$sum['order_month']."'";
      $amt = $amt.$sum['total_amount'];
      if($count < count($sums)) {
        $monthStr = $monthStr.",";
        $amt = $amt.",";
      }
    }
        
    $query = "SELECT m.`menu_id`, m.`name` AS menu_name, SUM(oi.`quantity`) AS total_quantity_ordered
    FROM `OrderItem` oi
    INNER JOIN `Menu` m ON oi.`menu_id` = m.`menu_id`
    INNER JOIN `Vendor` v ON m.`kiosk_id` = v.`kiosk_id`
    WHERE v.`user_id` = '$id'
    GROUP BY m.`menu_id`, m.`name`";
    $quantities = "";
    $labels = "";
    $menus = [];
    // Execute the query
    $result = mysqli_query($conn, $query);
    // Fetch the row
    while($row = mysqli_fetch_assoc($result)) {
      $menus[] = $row;
    }

    $count = 1;
    foreach($menus as $menu) {
      $quantities = $quantities.$menu['total_quantity_ordered'];
      $labels = $labels."'".$menu['menu_name']."'";
      if($count < count($menus)) {
        $quantities = $quantities.',';
        $labels = $labels.',';
      }
      $count++;
    }
    ?>
    $(document).ready(function() {
      const lineConfig = {
      type: 'line',
      data: {
        labels: [<?php echo $monthStr; ?>],
        datasets: [
          {
            label: 'Kiosk A',
            /**
             * These colors come from Tailwind CSS palette
             * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
             */
            backgroundColor: getRandomColorArray(<?php echo count($sums); ?>),
            borderColor: '#0694a2',
            data: [<?php echo $amt; ?>],
            fill: false,
          },
        ],
      },
      options: {
        responsive: true,
        /**
         * Default legends are ugly and impossible to style.
         * See examples in charts.html to add your own legends
         *  */
        legend: {
          display: true,
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true,
        },
        scales: {
          x: {
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Month',
            },
          },
          y: {
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Value',
            },
          },
        },
      },
    }

    // change this to the id of your chart element in HMTL
    const lineCtx = document.getElementById('line')
    window.myLine = new Chart(lineCtx, lineConfig)

    <?php 
    
    ?>
    const pieConfig = {
      type: 'doughnut',
      data: {
        datasets: [
          {
            data: [<?php echo $quantities; ?>],
            /**
             * These colors come from Tailwind CSS palette
             * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
             */
            backgroundColor: getRandomColorArray(<?php echo count($menus); ?>),
            label: 'Dataset 1',
          },
        ],
        
        labels: [<?php echo $labels; ?>],
      },
      options: {
        responsive: true,
        cutoutPercentage: 80,
        /**
         * Default legends are ugly and impossible to style.
         * See examples in charts.html to add your own legends
         *  */
        legend: {
          display: true,
        },
      },
    }

    // change this to the id of your chart element in HMTL
    const pieCtx = document.getElementById('pie')
    window.myPie = new Chart(pieCtx, pieConfig)
    })

    function getRandomColorArray(count) {
      const colorArray = [];
      for (let i = 0; i < count; i++) {
        const randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
        colorArray.push(randomColor);
      }
      return colorArray;
    }
  </script>
</body>

</html>