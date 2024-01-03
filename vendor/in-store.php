<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kiosk@UMPSA | In-Store</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <script src="https://replit.com/public/js/replit-badge-v2.js" theme="dark" position="bottom-right"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body class="poppins">

  <div class="flex items-center justify-center mt-8">
    <h1 class="text-center text-3xl md:text-4xl lg:text-5xl font-semibold text-gray-700">Kiosk A</h1>
  </div>
  
  <!-- Start Main Body -->
  <section class="my-12 max-w-screen-xl mx-auto px-6">

    <!-- Start Food Item -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-12">

      <!-- Individual Food -->
      <div
        class="bg-white border border-gray-100 transition transform duration-700 hover:shadow-xl hover:scale-105 p-4 rounded-lg relative">
        <img class="w-64 mx-auto transform transition duration-300 hover:scale-105"
          src="https://png.pngtree.com/png-clipart/20231016/original/pngtree-top-view-hainanese-chicken-rice-served-on-a-plate-with-soup-png-image_13323477.png"
          alt="" />
        <div class="flex flex-col items-center my-3 space-y-2">
          <h1 class="text-gray-900 text-lg">Nasi Ayam</h1>
          <p class="text-gray-500 text-sm text-center">Succulent braised chicken meat with fragrant rice</p>
          <h2 class="text-gray-900 text-2xl font-bold">RM12.00</h2>
          <img src="https://www.investopedia.com/thmb/hJrIBjjMBGfx0oa_bHAgZ9AWyn0=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/qr-code-bc94057f452f4806af70fd34540f72ad.png" class="w-1/2"/>
        </div>
      </div>

      <!-- Individual Food -->
      <div
        class="bg-white border border-gray-100 transition transform duration-700 hover:shadow-xl hover:scale-105 p-4 rounded-lg relative">
        <img class="w-64 mx-auto transform transition duration-300 hover:scale-105"
        src="https://png.pngtree.com/png-clipart/20230320/original/pngtree-plate-with-tasty-waffles-png-image_8997543.png"
        alt="" />
        <div class="flex flex-col items-center my-3 space-y-2">
          <h1 class="text-gray-900 text-lg">Waffle</h1>
          <p class="text-gray-500 text-sm text-center">Crispy on the outside, chewy on the inside</p>
          <h2 class="text-gray-900 text-2xl font-bold">RM4.00</h2>
          <img src="https://www.investopedia.com/thmb/hJrIBjjMBGfx0oa_bHAgZ9AWyn0=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/qr-code-bc94057f452f4806af70fd34540f72ad.png" class="w-1/2"/>
        </div>
      </div>

      <!-- Individual Food -->
      <div
        class="bg-white border border-gray-100 transition transform duration-700 hover:shadow-xl hover:scale-105 p-4 rounded-lg relative">
        <img class="mt-4 w-auto h-60 scale-105 mx-auto transform transition duration-300 hover:scale-110"
          src="../assets/nasi_lemak.png" alt="" />
        <div class="flex flex-col items-center my-3 space-y-2">
          <h1 class="text-gray-900 text-lg">Nasi Lemak</h1>
          <p class="text-gray-500 text-sm text-center">Malaysian traditional cuisine</p>
          <h2 class="text-gray-900 text-2xl font-bold">RM12.00</h2>
          <img src="https://www.investopedia.com/thmb/hJrIBjjMBGfx0oa_bHAgZ9AWyn0=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/qr-code-bc94057f452f4806af70fd34540f72ad.png" class="w-1/2"/>
        </div>
      </div>

     

      <!-- End Food Item -->
  </section>
  <!-- End Main Body -->
  
</body>
</html>