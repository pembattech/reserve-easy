<x-vendor-layout>

    <!-- Main Content -->
    <main class="flex-grow p-6 bg-white">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-semibold">
                Welcome, {{ Auth::check() ? Auth::user()->name : 'Guest' }}
            </h1>
            {{-- <button onclick="location.href='{{ route('#') }}'" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Add New Listing
            </button> --}}
        </header>

        <!-- Dashboard Metrics -->
        <section aria-label="Dashboard Metrics" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gray-100 p-6 rounded-lg text-center shadow-md">
                <h3 class="text-lg font-medium">Total Bookings</h3>
                <p class="text-2xl font-bold text-blue-600">124</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg text-center shadow-md">
                <h3 class="text-lg font-medium">Pending Requests</h3>
                <p class="text-2xl font-bold text-yellow-600">8</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg text-center shadow-md">
                <h3 class="text-lg font-medium">Earnings</h3>
                <p class="text-2xl font-bold text-green-600">$5,340</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg text-center shadow-md">
                <h3 class="text-lg font-medium">Cancelled Bookings</h3>
                <p class="text-2xl font-bold text-red-600">3</p>
            </div>
        </section>

        <!-- Recent Bookings -->
        <h2 class="text-2xl font-semibold mb-6">Recent Bookings</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-gray-50 p-5 rounded-lg shadow-sm">
                <h3 class="font-bold mb-2">Birthday Party</h3>
                <p class="text-sm text-gray-600">Date: Jan 15, 2024</p>
                <p class="text-sm text-gray-600">Time: 2:00 PM</p>
                <span class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs">Confirmed</span>
            </div>
            <div class="bg-gray-50 p-5 rounded-lg shadow-sm">
                <h3 class="font-bold mb-2">Corporate Event</h3>
                <p class="text-sm text-gray-600">Date: Jan 20, 2024</p>
                <p class="text-sm text-gray-600">Time: 6:00 PM</p>
                <span class="inline-block mt-2 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Pending</span>
            </div>
            <div class="bg-gray-50 p-5 rounded-lg shadow-sm">
                <h3 class="font-bold mb-2">Wedding Reception</h3>
                <p class="text-sm text-gray-600">Date: Feb 5, 2024</p>
                <p class="text-sm text-gray-600">Time: 4:00 PM</p>
                <span class="inline-block mt-2 px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs">Cancelled</span>
            </div>
            <div class="bg-gray-50 p-5 rounded-lg shadow-sm">
                <h3 class="font-bold mb-2">Anniversary Celebration</h3>
                <p class="text-sm text-gray-600">Date: Feb 10, 2024</p>
                <p class="text-sm text-gray-600">Time: 7:00 PM</p>
                <span class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs">Confirmed</span>
            </div>
        </div>
    </main>

</x-vendor-layout>
