<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Donation Routes
    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');

    // Ensure 'create' is above '/donations/{donation}'
    Route::get('/donations/create', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');

    // Edit and Update Routes
    Route::get('/donations/{donation}/edit', [DonationController::class, 'edit'])->name('donations.edit');
    Route::put('/donations/{donation}', [DonationController::class, 'update'])->name('donations.update');

    // Show and Delete
    Route::get('/donations/{donation}', [DonationController::class, 'show'])->name('donations.show');
    Route::delete('/donations/{donation}', [DonationController::class, 'destroy'])->name('donations.destroy');
});

require __DIR__.'/auth.php';
