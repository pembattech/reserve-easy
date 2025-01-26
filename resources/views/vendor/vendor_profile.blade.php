<x-vendor-layout>

        <main class="flex-grow p-6 bg-white">
            <header class="mb-8">
                <h1 class="text-3xl font-semibold">Vendor Profile</h1>
            </header>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Basic Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-medium">Business Name</label>
                            <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="Party Perfect Venues">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Email</label>
                            <input type="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="info@partyperfect.com">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Phone Number</label>
                            <input type="tel" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="+1 (555) 123-4567">
                        </div>
                    </div>
                </div>
                
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Business Details</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-medium">Business Type</label>
                            <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option>Event Venue</option>
                                <option>Party Planner</option>
                                <option>Catering Service</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Description</label>
                            <textarea class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="4">Premium event venue specializing in weddings, corporate events, and birthday parties.</textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 text-right">
                <button class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Save Changes</button>
            </div>
        </main>

    </x-vendor-layout>