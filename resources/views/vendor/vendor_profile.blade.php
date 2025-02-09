<x-vendor-layout>
    <main class="flex-grow p-6 bg-white">
        <header class="mb-8">
            <h1 class="text-3xl font-semibold">Vendor Profile</h1>
        </header>
        
        <form action="{{ route('vendor.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Basic Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-medium">Business Name</label>
                            <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('name', $vendor->name) }}">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Email</label>
                            <input type="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('email', $vendor->email) }}">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Phone Number</label>
                            <input type="tel" name="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('phone', $vendor->phone) }}">
                            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Business Details</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-medium">Business Type</label>
                            <select name="business_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Event Venue" {{ old('business_type', $vendor->business_type) == 'Event Venue' ? 'selected' : '' }}>Event Venue</option>
                                <option value="Party Planner" {{ old('business_type', $vendor->business_type) == 'Party Planner' ? 'selected' : '' }}>Party Planner</option>
                                <option value="Catering Service" {{ old('business_type', $vendor->business_type) == 'Catering Service' ? 'selected' : '' }}>Catering Service</option>
                            </select>
                            @error('business_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium">Description</label>
                            <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="4">{{ old('description', $vendor->description) }}</textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Save Changes</button>
            </div>
        </form>
    </main>
</x-vendor-layout>
