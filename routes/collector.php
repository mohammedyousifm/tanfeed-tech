<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Collector\DashboardController;

Route::middleware(['auth', 'collector'])->group(function () {
    Route::get('/collector/dashboard', [DashboardController::class, 'index'])->name('collector.dashboard');
});
