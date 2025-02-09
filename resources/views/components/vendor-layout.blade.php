<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body class="font-sans antialiased">

    @if (session('success'))
        <div class="text-green-500 bg-green-100 p-4 rounded">
            {{ session('success') }}
        </div>
    @endif


    <div class="bg-gray-100">
        <div class="flex h-screen">
            <div class="w-64 bg-gray-800 text-white p-6">
                <div class="text-center mb-10">
                    <h2 class="text-2xl font-bold">Vendor Platform</h2>
                </div>
                <nav>
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('vendor.dashboard') }}" class="hover:bg-gray-700 px-4 py-2 rounded block"
                                aria-current="{{ request()->routeIs('vendor.dashboard') ? 'page' : '' }}">
                                Dashboard
                            </a>
                        </li>
                        <li><a href="{{ route('vendor.booking_management') }}"
                                class="hover:bg-gray-700 px-4 py-2 rounded block">Bookings</a></li>
                        <li><a href="{{ route('vendor.vendor_profile') }}"
                                class="hover:bg-gray-700 px-4 py-2 rounded block">Profile</a></li>
                        <li><a href="{{ route('vendor.vendor_setting') }}"
                                class="hover:bg-gray-700 px-4 py-2 rounded block">Settings</a></li>
                        <li>
                            <form id="logoutForm" action="{{ route('vendor.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="hover:bg-gray-700 px-4 py-2 rounded block">
                                    Logout
                                </button>
                            </form>

                        </li>
                    </ul>
                </nav>
            </div>

            {{ $slot }}
        </div>
    </div>
</body>

</html>
