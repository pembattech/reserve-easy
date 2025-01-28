<x-guest-layout>
    <!-- Main Content -->
    <main class="flex-grow p-6 bg-white">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-semibold">
                {{ $vendor->name }} <span class="text-slate-600 text-base">Booking Management System</span>
            </h1>
        </header>

        <!-- Booking Summary Section -->
        <section aria-label="Booking Summary" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Current Booking Card -->
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-medium text-gray-900">Current Booking</h3>
                <div class="mt-4 space-y-4">
                    <!-- Booking Date -->
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Booking Date</p>
                            <p class="text-lg font-bold text-gray-800">{{ $booking_date }}</p>
                        </div>
                    </div>
                    <!-- Shift -->
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Shift</p>
                            <p class="text-lg font-bold text-gray-800">{{ ucfirst($shift) }}</p>
                        </div>
                    </div>
                    <!-- Guest Count -->
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Guest Count</p>
                            <p class="text-lg font-bold text-gray-800">{{ $guest }}</p>
                        </div>
                    </div>
                    <!-- Event Type -->
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Event Type</p>
                            <p class="text-lg font-bold text-gray-800">{{ ucfirst(str_replace('_', ' ', $type)) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Back to Form Button -->
                <a href="{{ url()->previous() }}"
                    class="mt-6 w-full inline-flex items-center justify-center border border-gray-300 text-gray-900 bg-white focus:ring-offset-2 transition-colors duration-200 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Form
                </a>
            </div>

            <!-- New Booking Form Section -->
            <div class="col-span-1 sm:col-span-2 lg:col-span-3">
                @include('booking.client_store')
            </div>
        </section>
    </main>

</x-guest-layout>
