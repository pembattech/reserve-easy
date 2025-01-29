<div id="bookingModal" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-96">
        <h2 class="text-2xl font-semibold mb-4">Booking Details</h2>

        <p><strong>Booking Date:</strong> <span id="modalDate"></span></p>
        <p><strong>Client:</strong> <span id="modalClient"></span></p>
        <p><strong>Type:</strong> <span id="modalType"></span></p>
        <p><strong>Shift:</strong> <span id="modalShift"></span></p>
        <p><strong>Guest:</strong> <span id="modalGuest"></span></p>

        <label class="block mt-4 font-semibold">Status:</label>
        <select id="modalStatus" class="border rounded p-2 w-full">
            <option value="pending">Pending</option>
            <option value="confirmed">Confirmed</option>
            <option value="canceled">Canceled</option>
        </select>

        <div class="flex justify-end mt-4">
            <button id="closeModal" class="px-4 py-2 bg-gray-400 text-white rounded mr-2">Close</button>
            <button id="saveStatus" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        // Function to capitalize the first letter of a string
        function ucfirst(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        $(".open-modal").click(function() {
            let bookingId = $(this).data("id");

            $.ajax({
                url: "/booking/get_booking_info/" + bookingId,
                method: "GET",
                success: function(response) {

                    $("#modalType").text(ucfirst(response.booking_detail.type));
                    $("#modalDate").text(response.booking_detail.booking_date);
                    $("#modalClient").text(ucfirst(response.booking_detail.client.name));
                    $("#modalShift").text(ucfirst(response.booking_detail.shift));
                    $("#modalGuest").text(response.booking_detail.guest);
                    $("#modalStatus").val(response.booking_detail.status);

                    $("#bookingModal").removeClass("hidden");

                    $("#saveStatus").attr("data-id", bookingId);

                },
                error: function() {
                    alert("Something went wrong.");
                }
            });
        });

        $("#closeModal").click(function() {
            $("#bookingModal").addClass("hidden");
        });


        $("#saveStatus").click(function() {
            let bookingId = $(this).data("id");
            let newStatus = $("#modalStatus").val();

            $.ajax({
                url: "/booking/update-booking-status",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: bookingId,
                    status: newStatus
                },
                success: function(response) {
                    // TODO: Send a update to the client.
                    alert("Status updated successfully!");
                    location.reload();
                },
                error: function() {
                    alert("Something went wrong.");
                }
            });
        });
    });
</script>
