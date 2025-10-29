<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Lawyer\DashboardController;
use App\Http\Controllers\Lawyer\ComplaintController;
use App\Http\Controllers\Lawyer\FollowUpController;
use App\Http\Controllers\Lawyer\CollectionsCollections;
use App\Http\Controllers\Lawyer\CollectorsController;
use App\Http\Controllers\Lawyer\MerchantController;

Route::middleware(['auth', 'lawyer'])->group(function () {

    // dashboard
    Route::get('/lawyer/dashboard', [DashboardController::class, 'index'])->name('lawyer.dashboard');

    // complaints
    Route::get('/lawyer/complaints', [ComplaintController::class, 'index'])->name('lawyer.complaints.index');
    Route::get('/lawyer/complaints/{id}/show', [ComplaintController::class, 'show'])->name('lawyer.complaints.show');
    Route::patch('/lawyer/complaints/{id}/status', [ComplaintController::class, 'updateStatus'])->name('lawyer.complaints.updateStatus');
    Route::patch('/lawyer/complaints/{id}/collectors', [ComplaintController::class, 'updateCollectors'])->name('lawyer.complaints.collectors.update');

    // Collectors
    Route::get('/lawyer/collectors', [CollectorsController::class, 'index'])->name('lawyer.collectors.index');
    Route::post('/lawyer/collectors', [CollectorsController::class, 'store'])->name('lawyer.collectors.store');
    Route::patch('/lawyer/collectors/{id}/status', [CollectorsController::class, 'updateStatus'])->name('lawyer.collectors.updateStatus');

    // merchant
    Route::get('/lawyer/merchant', [MerchantController::class, 'index'])->name('lawyer.merchant.index');
    Route::patch('/lawyer/merchant/{id}/status', [MerchantController::class, 'updateStatus'])->name('lawyer.merchant.updateStatus');
    Route::get('/lawyer/merchant/{id}/show', [MerchantController::class, 'show'])->name('lawyer.merchant.show');

    // Follow Up
    Route::get('/lawyer/complaints/{id}/followup', [FollowUpController::class, 'index'])->name('lawyer.complaints.followup');
    Route::post('/lawyer/follow-ups/store', [FollowUpController::class, 'store'])->name('lawyer.followups.store');

    // collections
    Route::get('/lawyer/complaints/{id}/collections', [CollectionsCollections::class, 'index'])->name('lawyer.complaints.collections');
    Route::Post('/lawyer/complaints/collections/store', [CollectionsCollections::class, 'store'])->name('lawyer.collections.store');
    Route::Post('/lawyer/collections/upload-tanfeed', [CollectionsCollections::class, 'uploadTanfeed'])->name('lawyer.collections.uploadTanfeed');
});
