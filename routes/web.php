<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\CharityController;
use App\Http\Controllers\DropoffLocationController;

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
// -------------------------------------------------------------------------------------------------------------------------------------------------
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
// -------------------------------------------------------------------------------------------------------------------------------------------------
// Charity Routes
    Route::get('/charities', [CharityController::class, 'index'])->name('charities.index');

    // Ensure 'create' is above '/charities/{charity}'
    Route::get('/charities/create', [CharityController::class, 'create'])->name('charities.create');
    Route::post('/charities', [CharityController::class, 'store'])->name('charities.store');

    // Edit and Update Routes
    Route::get('/charities/{charity}/edit', [CharityController::class, 'edit'])->name('charities.edit');
    Route::put('/charities/{charity}', [CharityController::class, 'update'])->name('charities.update');

    // Show and Delete
    Route::get('/charities/{charity}', [CharityController::class, 'show'])->name('charities.show');
    Route::delete('/charities/{charity}', [CharityController::class, 'destroy'])->name('charities.destroy');
// -------------------------------------------------------------------------------------------------------------------------------------------------
// Dropoff Routes
    Route::post('/dropoff-locations', [DropoffLocationController::class, 'store'])->middleware('auth');
    Route::get('/dropoff-locations', [DropoffLocationController::class, 'index']);

    Route::post('/donations/{donation}/assign-dropoff', [DonationController::class, 'assignDropoff'])->middleware('auth');

});

require __DIR__.'/auth.php';
