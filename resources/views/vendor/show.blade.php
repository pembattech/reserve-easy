<x-vendor-layout>

    <!-- Main Content -->
    <main class="flex-grow p-6 bg-white">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-semibold">
                Welcome, {{ Auth::user()->name }} <span class="text-slate-600 text-base">(
                    {{ $vendor->vendorUniqId->unique_id }} )</span>
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
                <p class="text-2xl font-bold text-blue-600">{{ $vendor->bookings->count() }}</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg text-center shadow-md">
                <h3 class="text-lg font-medium">Pending Requests</h3>
                <p class="text-2xl font-bold text-yellow-600">
                    {{ $vendor->bookings->where('status', 'pending')->count() }}</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg text-center shadow-md">
                <h3 class="text-lg font-medium">Earnings</h3>
                <p class="text-2xl font-bold text-green-600">$5,340</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg text-center shadow-md">
                <h3 class="text-lg font-medium">Cancelled Bookings</h3>
                <p class="text-2xl font-bold text-red-600">{{ $vendor->bookings->where('status', 'canceled')->count() }}
                </p>
            </div>
        </section>

        <!-- Recent Bookings -->
        <h2 class="text-2xl font-semibold mb-6">Recent Bookings</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @forelse ($recentBookings as $item)
                <div class="bg-gray-50 p-5 rounded-lg shadow-sm">
                    <h3 class="font-bold mb-2">{{ ucwords(str_replace('_', ' ', $item->type)) }}</h3>
                    <p class="text-sm text-gray-600">Date: {{ $item->created_at->format('M d, Y') }}</p>
                    <p class="text-sm text-gray-600">Time: {{ $item->created_at->format('h:i A') }}</p>
                    <span
                        class="inline-block mt-2 px-3 py-1 
                            @if ($item->status === 'confirmed') bg-green-100 text-green-800
                            @elseif($item->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 
                            @endif
                            rounded-full text-xs">
                        {{ ucfirst($item->status) }}
                    </span>
                </div>
            @empty
                <p class="text-gray-500">No recent bookings available.</p>
            @endforelse
        </div>
    </main>

</x-vendor-layout>
