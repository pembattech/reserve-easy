<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\VendorAuthController;
use App\Http\Controllers\VendorController;

Route::prefix('vendor')->group(function () {
    Route::get('/register', [VendorAuthController::class, 'showRegisterForm'])->name('vendor.register');
    Route::post('/register', [VendorAuthController::class, 'register'])->name('vendor.register');
    Route::get('/login', [VendorAuthController::class, 'showLoginForm'])->name('vendor.login');
    Route::post('/login', [VendorAuthController::class, 'login']);
    Route::post('/logout', [VendorAuthController::class, 'logout'])->name('vendor.logout');
});


Route::middleware('auth:vendor')->group(function () {

    Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index'); //Admin site to view all the vendors.
    Route::get('/vendor/dashboard', [VendorController::class, 'show'])->name('vendor.dashboard');
    Route::get('/vendor/booking_management', [VendorController::class, 'booking_management'])->name('vendor.booking_management');
    Route::get('/vendor/profile', [VendorController::class, 'vendor_profile'])->name('vendor.vendor_profile');
    Route::get('/vendor/setting', [VendorController::class, 'vendor_setting'])->name('vendor.vendor_setting');
});

Route::prefix('booking')->group(function () {
    Route::get('/onlinebooking', [BookingController::class, 'onlinebooking']);
    Route::get('/client', [ClientController::class, 'client']);
    Route::post('/clientstore', [ClientController::class, 'client_store'])->name('booking.clientstore');
    Route::post('/validate-otp', [ClientController::class, 'validateOtp'])->name('booking.otpvalidate');


});



require __DIR__ . '/auth.php';
