<?php

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
    Route::post('/register', [VendorAuthController::class, 'register']);
    Route::get('/login', [VendorAuthController::class, 'showLoginForm'])->name('vendor.login');
    Route::post('/login', [VendorAuthController::class, 'login']);
    Route::post('/logout', [VendorAuthController::class, 'logout'])->name('vendor.logout');
});

Route::middleware('auth:vendor')->group(function () {
    
    Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index');
    Route::get('/vendor/dashboard', [VendorController::class, 'show'])->name('vendor.show');
});



require __DIR__.'/auth.php';
