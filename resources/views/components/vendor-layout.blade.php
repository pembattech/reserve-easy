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

    <!-- Shared Style -->


</head>

<body class="font-sans antialiased">

    @if (session('success'))
        <div id="success-message" class="alert-box bg-green-50 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div id="error-message" class="alert-box bg-red-50 text-red-800">
            {{ session('error') }}
        </div>
    @endif

    <!-- Alert Container -->
    <div id="alert" class="alert-box hidden">
        <div id="alert-message"></div>
    </div>

    <style>
        .alert-box {
            position: fixed;
            top: 1rem;
            right: 1rem;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: scale(0.75);
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
            z-index: 50;
        }

        .show-alert {
            opacity: 1 !important;
            transform: scale(1) !important;
        }

        .hidden {
            display: none;
        }
    </style>

    <div class="bg-gray-100">
        <div class="flex">
            <div class="w-64 bg-gray-800 text-white p-6 sticky top-0 h-screen max-h-screen">
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

    <!-- Script for Session Messages -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');

            function showMessage(element) {
                if (element) {
                    element.classList.remove('hidden');
                    setTimeout(() => {
                        element.classList.add('show-alert');
                    }, 10);

                    setTimeout(() => {
                        element.classList.remove('show-alert');
                        setTimeout(() => {
                            element.classList.add('hidden');
                        }, 500);
                    }, 5000);
                }
            }

            showMessage(successMessage);
            showMessage(errorMessage);
        });
    </script>

    <!-- Script for Dynamic Messages -->
    <script>
        function showAlert(message, bgColor, textColor) {
            const $alertContainer = $('#alert');
            const $alertMessage = $('#alert-message');

            $alertMessage.text(message)
                .removeClass()
                .addClass(`${bgColor} ${textColor}`);

            $alertContainer.removeClass('hidden');
            setTimeout(() => {
                $alertContainer.addClass('show-alert bg-green-50');
            }, 10);

            setTimeout(() => {
                $alertContainer.removeClass('show-alert');
                setTimeout(() => {
                    $alertContainer.addClass('hidden');
                }, 500);
            }, 5000);
        }
    </script>
</body>

</html>
