<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Lawyer\DashboardController;

Route::middleware(['auth', 'lawyer'])->group(function () {
    Route::get('/lawyer/dashboard', [DashboardController::class, 'index'])->name('lawyer.dashboard');
});
