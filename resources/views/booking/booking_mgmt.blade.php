<x-vendor-layout>

    <main class="flex-grow p-6 bg-white">
        <header class="mb-4">
            <h1 class="text-3xl font-semibold">Bookings Management</h1>
            <button id="openPopup-addbooking" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded hover:bg-blue-600">Add
                Booking</button>
        </header>

        <div class="bg-white shadow-md rounded-lg max-h-[80vh] overflow-auto">
            <table class="w-full">
                <thead class="bg-gray-100 sticky top-0">
                    <tr>
                        <th class="px-6 py-3 text-left">Event Name</th>
                        <th class="px-6 py-3 text-left">Date</th>
                        <th class="px-6 py-3 text-left">Guest Name</th>
                        <th class="px-6 py-3 text-left">Shift</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendor->bookings as $booking)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ ucwords(str_replace('_', ' ', $booking->type)) }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4">{{ $booking->client->name }}</td>
                            <td class="px-6 py-4">{{ str_replace('_', ' ', $booking->shift) }}</td>
                            <td class="px-6 py-4">
                                @if ($booking->status == 'confirmed')
                                    <span
                                        class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Confirmed</span>
                                @elseif ($booking->status == 'pending')
                                    <span
                                        class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Pending</span>
                                @else
                                    <span
                                        class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">{{ ucfirst($booking->status) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <button class="text-blue-500 hover:text-blue-700 mr-3 open-modal"
                                    data-id="{{ $booking->id }}">
                                    View
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Popup Container -->
        <div id="popup-addbooking" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md h-[90vh] overflow-y-auto">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800 text-center">Add Booking</h2>
                
                <!-- Booking Form -->
                <form id="bookingForm" method="POST" novalidate class="space-y-4">
                    <div class="grid gap-4">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-gray-700 font-medium">Name:</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                            <div id="nameError" class="text-red-500 text-sm mt-1"></div>
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-gray-700 font-medium">Email:</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                            <div id="emailError" class="text-red-500 text-sm mt-1"></div>
                        </div>
                        
                        <!-- Contact Number -->
                        <div>
                            <label for="contact" class="block text-gray-700 font-medium">Contact Number:</label>
                            <input type="tel" id="contact" name="contact" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                            <div id="contactError" class="text-red-500 text-sm mt-1"></div>
                        </div>
                    </div>
                    
                    <!-- Grid Layout -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="date" class="block text-gray-700 font-medium">Booking Date:</label>
                            <input type="date" id="date" name="booking_date" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                            <div id="dateError" class="text-red-500 text-sm mt-1"></div>
                        </div>
                        
                        <div>
                            <label for="guest" class="block text-gray-700 font-medium">Guest (Number):</label>
                            <input type="number" id="guest" name="guest" min="1" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                            <div id="guestError" class="text-red-500 text-sm mt-1"></div>
                        </div>
                        
                        <div>
                            <label for="shift" class="block text-gray-700 font-medium">Shift:</label>
                            <select id="shift" name="shift" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                                <option value="">Select shift</option>
                                <option value="morning">Morning</option>
                                <option value="evening">Evening</option>
                                <option value="whole_day">Whole Day</option>
                            </select>
                            <div id="shiftError" class="text-red-500 text-sm mt-1"></div>
                        </div>
                        
                        <div>
                            <label for="type" class="block text-gray-700 font-medium">Type:</label>
                            <select id="type" name="type" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                                <option value="">Select type</option>
                                <option value="wedding">Wedding</option>
                                <option value="birthday">Birthday</option>
                                <option value="corporate_event">Corporate Event</option>
                                <option value="other">Other</option>
                            </select>
                            <div id="typeError" class="text-red-500 text-sm mt-1"></div>
                        </div>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" id="closePopup-addbooking" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit</button>
                    </div>
                </form>
            </div>
        </div>
                      

        @include('booking.booking_detail')

    </main>

</x-vendor-layout>
