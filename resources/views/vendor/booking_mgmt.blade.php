<x-vendor-layout>

    <main class="flex-grow p-6 bg-white">
        <header class="mb-8">
            <h1 class="text-3xl font-semibold">Bookings Management</h1>
        </header>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
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
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</td>
                            <td class="px-6 py-4">{{ $booking->client->name }}</td>
                            <td class="px-6 py-4">{{ str_replace('_', ' ', $booking->shift) }}</td>
                            <td class="px-6 py-4">
                                @if ($booking->status == 'confirmed')
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Confirmed</span>
                                @elseif ($booking->status == 'pending')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Pending</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">{{ ucfirst($booking->status) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <button class="text-blue-500 hover:text-blue-700 mr-3 open-modal" 
                                    data-id="{{ $booking->id }}">
                                    View
                                </button>
                                <button class="text-red-500 hover:text-red-700">Cancel</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('vendor.booking_detail')
    </main>

</x-vendor-layout>
