<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\LandingPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Merchant\CompanyProfileController;
use App\Http\Controllers\Merchant\DashboardController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing');

Route::get('/company-profiles', [CompanyProfileController::class, 'index'])->name('company_profiles.index');
Route::post('/company-profiles', [CompanyProfileController::class, 'store'])->name('company_profiles.store');

Route::middleware(['auth', 'verified', 'merchant'])->group(function () {
    Route::get('/merchant/dashboard', [DashboardController::class, 'index'])->name('merchant.dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/lawyer.php';
require __DIR__ . '/collector.php';
require __DIR__ . '/auth.php';
