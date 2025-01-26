<x-vendor-layout>

    <main class="flex-grow p-6 bg-white">
        <header class="mb-8">
            <h1 class="text-3xl font-semibold">Account Settings</h1>
        </header>

        <div class="space-y-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Notification Preferences</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700">Email Notifications</span>
                        <label class="flex items-center cursor-pointer">
                            <div class="relative">
                                <input type="checkbox" class="sr-only" checked />
                                <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                                <div
                                    class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition">
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700">SMS Notifications</span>
                        <label class="flex items-center cursor-pointer">
                            <div class="relative">
                                <input type="checkbox" class="sr-only" />
                                <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                                <div
                                    class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition">
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Security</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-medium">Current Password</label>
                        <input type="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium">New Password</label>
                        <input type="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium">Confirm New Password</label>
                        <input type="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Save Settings</button>
            </div>
        </div>
    </main>

</x-vendor-layout>
