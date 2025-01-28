    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gray-800 px-8 py-6 animate-slide-up">
            <h1 class="text-2xl font-bold text-white">Add New Booking</h1>
            <p class="text-blue-100 mt-2">Please fill in your booking details</p>
        </div>

        <!-- Form -->
        <div class="p-8">
            <form id="newBookingForm" method="POST" class="space-y-2">
                @csrf
                <!-- Name Input -->
                <div class="animate-slide-up delay-1">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" id="name" name="name" required
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg
                                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                          text-gray-900 placeholder-gray-400 bg-white
                                          transition duration-150 ease-in-out"
                            placeholder="Enter your full name">
                    </div>
                </div>

                <!-- Email Input -->
                <div class="animate-slide-up delay-2">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="email" id="email" name="email" required
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg
                                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                          text-gray-900 placeholder-gray-400 bg-white
                                          transition duration-150 ease-in-out"
                            placeholder="Enter your email address">
                    </div>
                </div>

                <!-- Contact Input -->
                <div class="animate-slide-up delay-3">
                    <label for="contact" class="block text-sm font-medium text-gray-700 mb-2">Contact</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <input type="number" id="contact" name="contact" required
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg
                                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                          text-gray-900 placeholder-gray-400 bg-white
                                          transition duration-150 ease-in-out"
                            placeholder="Enter your contact number">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="animate-slide-up delay-4">
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg
                                       shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700
                                       focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                                       transition-colors duration-200">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Submit Booking
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>


    <!-- OTP Popup Overlay -->
    <div id="otpPopupOverlay" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm hidden z-40">
    </div>

    <!-- OTP Popup -->
    <div id="otpPopup"
        class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 
       w-full max-w-md bg-white rounded-2xl shadow-2xl p-8 hidden z-50">
        <form method="POST" class="space-y-6">
            @csrf

            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Enter OTP</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Please enter the verification code sent to your device
                </p>
            </div>

            <!-- OTP Input -->
            <div class="space-y-4">
                <div>
                    <input type="text" id="otpInput" maxlength="5" required
                        class="block w-full px-4 py-3 text-center tracking-[1em] font-mono text-2xl
                         border-2 border-gray-300 rounded-lg
                         placeholder:text-gray-400
                         focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                         transition-colors duration-200"
                        placeholder="•••••">
                </div>

                <!-- Validate Button -->
                <button type="button" id="validateOtpButton"
                    class="w-full inline-flex justify-center items-center px-6 py-3 
                      bg-blue-600 hover:bg-blue-700 
                      text-white font-medium rounded-lg
                      focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                      transition-colors duration-200
                      disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Validate OTP
                </button>
            </div>

            <!-- Resend Option -->
            <div class="text-center">
                <button type="button"
                    class="text-sm text-blue-600 hover:text-blue-800 font-medium
                      focus:outline-none focus:underline
                      transition-colors duration-200">
                    Resend OTP
                </button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Handle form submission for new booking
            $('#newBookingForm').on('submit', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                console.log(formData);

                $.ajax({
                    url: "{{ route('booking.clientstore') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        console.log(response)
                        if (response.otp) {

                            // Store the contact in localStorage
                            const contact = $('#contact').val();
                            localStorage.setItem('contact', contact);

                            // Display the OTP popup
                            $('#otpPopupOverlay').fadeIn();
                            $('#otpPopup').fadeIn();
                        }
                    },
                    error: function() {
                        alert("Error submitting form.");
                    }
                });
            });

            // Handle OTP validation
            $('#validateOtpButton').on('click', function() {
                const enteredOtp = $('#otpInput').val();
                const contact = localStorage.getItem('contact');

                $.ajax({
                    url: "{{ route('booking.otpvalidate') }}",
                    method: "POST",
                    data: {
                        otp: enteredOtp,
                        contact: contact,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        if (response.success) {
                            // Close the popup
                            $('#otpPopupOverlay').fadeOut();
                            $('#otpPopup').fadeOut();
                            alert(response.success);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error validating OTP:", error);
                        alert("An error occurred while validating the OTP.");
                    }
                });
            });
        });
    </script>
