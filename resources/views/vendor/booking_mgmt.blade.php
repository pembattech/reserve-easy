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
                        <th class="px-6 py-3 text-left">Time</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="px-6 py-4">Birthday Party</td>
                        <td class="px-6 py-4">Jan 15, 2024</td>
                        <td class="px-6 py-4">2:00 PM</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Confirmed</span>
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-blue-500 hover:text-blue-700 mr-3">View</button>
                            <button class="text-red-500 hover:text-red-700">Cancel</button>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-6 py-4">Wedding Reception</td>
                        <td class="px-6 py-4">Feb 2, 2024</td>
                        <td class="px-6 py-4">6:00 PM</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Pending</span>
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-blue-500 hover:text-blue-700 mr-3">View</button>
                            <button class="text-red-500 hover:text-red-700">Cancel</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

</x-vendor-layout>
