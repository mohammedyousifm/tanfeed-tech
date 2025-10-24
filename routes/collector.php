<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Collector\DashboardController;
use App\Http\Controllers\Collector\ComplaintController;
use App\Http\Controllers\Collector\FollowUpController;
use App\Http\Controllers\Collector\CollectionsCollections;


Route::middleware(['auth', 'collector'])->group(function () {
    Route::get('/collector/dashboard', [DashboardController::class, 'index'])->name('collector.dashboard');

    // complaints
    Route::get('/collector/complaints', [ComplaintController::class, 'index'])->name('collector.complaints.index');

    // Follow Up
    Route::get('/collector/complaints/{id}/followup', [FollowUpController::class, 'index'])->name('collector.complaints.followup');
    Route::post('/collector/follow-ups/store', [FollowUpController::class, 'store'])->name('collector.followups.store');


    // collections
    Route::get('/collector/complaints/{id}/collections', [CollectionsCollections::class, 'index'])->name('collector.complaints.collections');
    Route::Post('/collector/complaints/collections/store', [CollectionsCollections::class, 'store'])->name('collector.collections.store');
    Route::Post('/collector/collections/upload-tanfeed', [CollectionsCollections::class, 'uploadTanfeed'])->name('collector.collections.uploadTanfeed');
});
