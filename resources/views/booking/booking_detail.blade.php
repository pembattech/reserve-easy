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
                    if (response.status == 'success') {

                        console.log(newStatus)

                        // Update the status badge dynamically
                        let row = $("#booking-row-" + bookingId);

                        let statusCell = row.find(".status-column");

                        let statusClass = "";
                        if (newStatus === "confirmed") {
                            statusClass = "bg-green-100 text-green-800";
                        } else if (newStatus === "pending") {
                            statusClass = "bg-yellow-100 text-yellow-800";
                        } else {
                            statusClass = "bg-gray-100 text-gray-800";
                        }

                        // Replace the status text
                        statusCell.html(
                            `<span class="px-2 py-1 ${statusClass} rounded-full text-xs">${newStatus.charAt(0).toUpperCase() + newStatus.slice(1)}</span>`
                        );

                        // TODO: Send a update to the client.

                        showAlert(response.message, 'bg-green-50', 'text-green-800');

                        $("#bookingModal").addClass("hidden");
                        
                    } else {
                        showAlert(response.message, 'bg-red-50', 'text-red-800');
                    }
                },
                error: function() {
                    showAlert('An error occurred. Please try again.', 'bg-red-50',
                        'text-red-800');
                }
            });
        });

        // Show the popup
        $("#openPopup-addbooking").click(function() {
            $(".error").text("");
            $("#popup-addbooking").removeClass("hidden");
        });

        // Hide the popup
        $("#closePopup-addbooking").click(function() {
            $("#bookingForm")[0].reset();
            $(".text-red-500").text("");
            $("#popup-addbooking").addClass("hidden");
        });

        $("#bookingForm").submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            // Clear previous error messages
            $(".text-red-500").text("");

            // Get form values
            let name = $("#name").val().trim();
            let email = $("#email").val().trim();
            let contact = $("#contact").val().trim();
            let date = $("#date").val();
            let shift = $("#shift").val();
            let guest = $("#guest").val();
            let type = $("#type").val();
            let isValid = true;

            // Validate Name
            if (!name) {
                $("#nameError").text("Name is required.");
                isValid = false;
            }

            // Validate Email
            let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!email.match(emailPattern)) {
                $("#emailError").text("Enter a valid email.");
                isValid = false;
            }

            // Validate Contact Number
            let phonePattern = /^[0-9]{10}$/;
            if (!contact.match(phonePattern)) {
                $("#contactError").text("Enter a valid 10-digit phone number.");
                isValid = false;
            }

            // Validate Booking Date
            if (!date) {
                $("#dateError").text("Booking date is required.");
                isValid = false;
            }

            // Validate Shift
            if (!shift) {
                $("#shiftError").text("Please select a shift.");
                isValid = false;
            }

            // Validate Guest Count
            if (!guest || guest < 1) {
                $("#guestError").text("Guest number must be at least 1.");
                isValid = false;
            }

            // Validate Type
            if (!type) {
                $("#typeError").text("Please select a booking type.");
                isValid = false;
            }

            // If form is valid, submit via AJAX
            if (isValid) {

                let formData = $(this).serialize();
                let csrfToken = $('meta[name="csrf-token"]').attr("content");

                $.ajax({
                    url: "/booking/manual-book",
                    type: "POST",
                    data: formData,
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            let booking = response.booking;

                            // Convert first letter to uppercase
                            let eventType = ucfirst(booking.type);
                            let bookingDate = new Date(booking.booking_date)
                                .toLocaleDateString('en-US', {
                                    // weekday: 'long', // e.g., Monday
                                    year: 'numeric', // e.g., 2025
                                    month: 'short', // e.g., Feb
                                    day: '2-digit' // e.g., 10
                                });
                            let shiftType = booking.shift;
                            let bookingStatus = ucfirst(booking.status);

                            // Determine status label color
                            let statusClass = (booking.status === 'confirmed') ?
                                'bg-green-100 text-green-800' :
                                (booking.status === 'pending') ?
                                'bg-yellow-100 text-yellow-800' :
                                'bg-gray-100 text-gray-800';

                            // Create new row
                            let newRow = `
                                <tr class="border-b">
                                    <td class="px-6 py-4">${eventType}</td>
                                    <td class="px-6 py-4">${bookingDate}</td>
                                    <td class="px-6 py-4">${booking.client_name}</td>
                                    <td class="px-6 py-4">${shiftType}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 ${statusClass} rounded-full text-xs">
                                            ${bookingStatus}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">${booking.booking_source}</td>
                                    <td class="px-6 py-4">
                                        <button class="text-blue-500 hover:text-blue-700 mr-3 open-modal" data-id="${booking.id}">
                                            View
                                        </button>
                                    </td>
                                </tr>
                            `;
                            // Append new row to the table
                            $("table tbody").prepend(newRow);

                            // Reset the form after successful submission
                            $("#bookingForm")[0].reset();

                            showAlert(response.message, 'bg-green-50', 'text-green-800');

                            $("#popup-addbooking").addClass("hidden");
                        } else {
                            showAlert(response.message, 'bg-red-50', 'text-red-800');
                        }
                    },
                    error: function(error) {
                        console.log(error); // Handle errors
                        showAlert('An error occurred. Please try again.', 'bg-red-50',
                            'text-red-800');
                    }
                });
            }
        });
    });
</script>
