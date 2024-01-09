<!-- Update user modal -->
<script>
$(document).ready(function() {

    var menuId;

    $('[data-modal-toggle="edit-order-modal"]').click(function() {
        menuId = $(this).data('menu-id');
        
        // Fetch user using userId
        $.ajax({
            type: "POST",
            url: "../php_function/fetchMenuProcess.php",
            data: {
                id: menuId
            },
            success: function(data) {
                var menu = data;
                console.log(menu)
                $('#menuname-edit').val(menu.name);
                $('#description-edit').val(menu.description);
                $('#price-edit').val(menu.price);
                $('#quantity-edit').val(menu.quantity_remaining);
                $('#image-edit').val(menu.image);
            }
        });
    });

    $('#edit-order-form').submit(function(e) {

        e.preventDefault();

        var name = $('#menuname-edit').val();
        var description = $('#description-edit').val();
        var price = $('#price-edit').val();
        var quantity = $('#quantity-edit').val();
        var image = $('#image-edit').val() ?? NULL;

        $.ajax({
            type: "POST",
            url: "../php_function/updateMenuProcess.php",
            data: {
                id: menuId,
                name: name,
                description: description,
                price: price,
                quantity: quantity,
                image: image
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data[0] == "true") {
                    alert("Menu updated successfully");
                    location.reload();
                } else {
                    alert("Menu update failed");
                }
            }
        });
    });
});
</script>
<div id="edit-order-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Update Order
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-order-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="edit-order-form" class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="menuname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Menu Name</label>
                        <input type="text" name="menuname" id="menuname-edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Food Name" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="number" name="price" id="price-edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="5.50" required step=".01" min="0" value="0">
                    </div>
                    <div class="col-span-2">
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                        <input type="number" name="quantity" id="quantity-edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="50 etc" required>
                    </div>
                    <div class="col-span-2">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                        <input type="text" name="image" id="image-edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="link image" required>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Update order
                </button>
            </form>
        </div>
    </div>
</div>