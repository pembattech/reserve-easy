<x-guest-layout>
    <style>
        @keyframes floatIn {
            0% { transform: translateY(30px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
        
        @keyframes scaleIn {
            0% { transform: scale(0.9); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        
        .animate-float {
            animation: floatIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        
        .animate-scale {
            animation: scaleIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
    </style>
</head>
<body class="min-h-screen bg-gray-50">
    <!-- Side Navigation Bar -->
    <nav class="fixed top-0 left-0 h-full w-20 bg-blue-600 flex flex-col items-center py-8 animate-float delay-1">
        <div class="w-12 h-12 bg-white rounded-full mb-8 flex items-center justify-center">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div class="flex-1 flex flex-col items-center space-y-6">
            <a href="#" class="w-12 h-12 rounded-lg bg-blue-700 flex items-center justify-center text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="ml-20 p-8">
        <!-- Header Section -->
        <header class="max-w-7xl mx-auto mb-12 animate-float delay-2">
            <h1 class="text-4xl font-bold text-gray-900">{{ $vendor }}</h1>
            <p class="mt-2 text-gray-600">Booking Management System</p>
        </header>

        <div class="max-w-7xl mx-auto">
            <div class="flex flex-row lg:flex-row gap-8">
                <!-- Booking Summary Card -->
                <div class="lg:w-1/3 animate-scale delay-1">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="bg-blue-600 px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">Current Booking</h2>
                        </div>
                        <div class="p-6 space-y-6">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Booking Date</p>
                                    <p class="text-lg font-medium text-gray-900" id="booking_date">{{ $booking_date }}</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Shift</p>
                                    <p class="text-lg font-medium text-gray-900" id="shift">{{ ucfirst($shift) }}</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Guest Count</p>
                                    <p class="text-lg font-medium text-gray-900" id="guest">{{ $guest }}</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Event Type</p>
                                    <p class="text-lg font-medium text-gray-900" id="type">{{ ucfirst(str_replace('_', ' ', $type)) }}</p>
                                </div>
                            </div>

                            <a href="{{ url()->previous() }}" 
                               class="mt-6 w-full inline-flex items-center justify-center px-6 py-3 border border-transparent 
                                      text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 
                                      focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 
                                      transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Form
                            </a>
                        </div>
                    </div>
                </div>

                <!-- New Booking Form Section -->
                <div class="lg:w-2/3 animate-scale delay-2">
                    <div class="bg-white rounded-2xl shadow-lg">
                        @include('booking.client_store')
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function storeBookingData(bookingData) {
            localStorage.setItem('booking', JSON.stringify(bookingData));
        }

        const urlParams = new URLSearchParams(window.location.search);
        const bookingData = [{
            booking_date: urlParams.get('booking_date'),
            shift: urlParams.get('shift'),
            guest: urlParams.get('guest'),
            type: urlParams.get('type'),
        }];

        storeBookingData(bookingData);
    </script>


</x-guest-layout>