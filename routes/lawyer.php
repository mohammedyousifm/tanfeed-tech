<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Lawyer\DashboardController;
use App\Http\Controllers\Lawyer\ComplaintController;
use App\Http\Controllers\Lawyer\FollowUpController;
use App\Http\Controllers\Lawyer\CollectionsCollections;

Route::middleware(['auth', 'lawyer'])->group(function () {
    Route::get('/lawyer/dashboard', [DashboardController::class, 'index'])->name('lawyer.dashboard');

    Route::get('/lawyer/complaints', [ComplaintController::class, 'index'])->name('lawyer.complaints.index');
    Route::patch('/lawyer/complaints/{id}/status', [ComplaintController::class, 'updateStatus'])->name('lawyer.complaints.updateStatus');

    // Follow Up
    Route::get('/lawyer/complaints/{id}/followup', [FollowUpController::class, 'index'])->name('lawyer.complaints.followup');
    Route::post('/lawyer/follow-ups/store', [FollowUpController::class, 'store'])->name('lawyer.followups.store');


    // collections
    Route::get('/lawyer/complaints/{id}/collections', [CollectionsCollections::class, 'index'])->name('lawyer.complaints.collections');
    Route::Post('/lawyer/complaints/collections/store', [CollectionsCollections::class, 'store'])->name('lawyer.collections.store');
    Route::Post('/lawyer/collections/upload-tanfeed', [CollectionsCollections::class, 'uploadTanfeed'])->name('lawyer.collections.uploadTanfeed');
});
