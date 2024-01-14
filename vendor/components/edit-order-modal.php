<!-- Update user modal -->
<script>
$(document).ready(function() {

    var orderId;

    $('[data-modal-toggle="edit-order-modal"]').click(function() {
        orderId = $(this).data('order-id');
        
        // Fetch user using userId
        $.ajax({
            type: "POST",
            url: "../php_function/fetchOrderProcess.php",
            data: {
                id: orderId
            },
            success: function(data) {
                var order = data;
                // console.log(order.status)
                // $('#status-edit option[value='+order.status+']').attr('selected', true);
                $('#status-edit').val(order.status);
            }
        });
    });

    $('#edit-order-form').submit(function(e) {

        e.preventDefault();
        var status = $('#status-edit :selected').val();

        $.ajax({
            type: "POST",
            url: "../php_function/updateOrderProcess.php",
            data: {
                id: orderId,
                status: status
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data[0] == "true") {
                    alert("Order updated successfully");
                    location.reload();
                } else {
                    alert("Order update failed");
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
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="status-edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="Ordered">Ordered</option>
                            <option value="Preparing">Preparing</option>
                            <option value="Prepared">Prepared</option>
                            <option value="Completed">Completed</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Update Order
                </button>
            </form>
        </div>
    </div>
</div>