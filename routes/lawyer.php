<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Lawyer\DashboardController;
use App\Http\Controllers\Lawyer\ComplaintController;
use App\Http\Controllers\Lawyer\PhoneController;
use App\Http\Controllers\Lawyer\FollowUpController;
use App\Http\Controllers\Lawyer\CollectionsCollections;
use App\Http\Controllers\Lawyer\CollectorsController;
use App\Http\Controllers\Lawyer\MerchantController;
use App\Http\Controllers\Lawyer\SettingsController;
use App\Http\Controllers\Lawyer\NotificationController;

use App\Http\Controllers\Lawyer\Complaints\UpdateStatusController;
use App\Http\Controllers\Lawyer\Complaints\PaymentDatesController;
/*
|--------------------------------------------------------------------------
| Lawyer Routes (Authenticated + Lawyer Role)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'lawyer'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/lawyer/dashboard', [DashboardController::class, 'index'])
        ->name('lawyer.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Complaints
    |--------------------------------------------------------------------------
    */
    Route::prefix('lawyer/complaints')->name('lawyer.complaints.')->group(function () {
        Route::get('/', [ComplaintController::class, 'index'])->name('index');
        Route::get('/{id}/show', [ComplaintController::class, 'show'])->name('show');
        Route::delete('/{complaint}', [ComplaintController::class, 'destroy'])->name('destroy');

        // Complaint actions
        Route::patch('/{id}/status', [UpdateStatusController::class, 'updateStatus'])->name('updateStatus');
        Route::patch('/{id}/collectors', [ComplaintController::class, 'updateCollectors'])->name('collectors.update');

        // Filtered complaint lists
        Route::get('/obtainedcontracts', [ComplaintController::class, 'obtainedcontracts'])->name('obtainedcontracts');
        Route::get('/neglectedcontracts', [ComplaintController::class, 'neglectedcontracts'])->name('neglectedcontracts');
        Route::get('/cancelled', [ComplaintController::class, 'cancelled'])->name('cancelled');

        // Export
        Route::get('/export-unavailable', [ComplaintController::class, 'exportUnavailable'])->name('export-unavailable');

        // Follow-up
        Route::get('/{id}/followup', [FollowUpController::class, 'index'])->name('followup');

        // Collections
        Route::get('/{id}/collections', [CollectionsCollections::class, 'index'])->name('collections');
    });


    /*
    |--------------------------------------------------------------------------
    | lawyer payment dates
    |--------------------------------------------------------------------------
    */
    Route::prefix('lawyer/payment')->name('lawyer.payment.')->group(function () {
        Route::get('/', [PaymentDatesController::class, 'index'])->name('dates');
    });

    /*
    |--------------------------------------------------------------------------
    | Phone Management
    |--------------------------------------------------------------------------
    */
    Route::prefix('lawyer')->name('lawyer.complaints.')->group(function () {
        Route::patch('/phone-status/{id}/status', [PhoneController::class, 'updateStatus'])->name('updateStatus');
        Route::put('/phone-number/{complaint}/update-phones', [PhoneController::class, 'updatePhones'])->name('updatePhones');
    });

    /*
    |--------------------------------------------------------------------------
    | Collectors
    |--------------------------------------------------------------------------
    */
    Route::prefix('lawyer/collectors')->name('lawyer.collectors.')->group(function () {
        Route::get('/', [CollectorsController::class, 'index'])->name('index');
        Route::post('/', [CollectorsController::class, 'store'])->name('store');
        Route::delete('/{collector}', [CollectorsController::class, 'destroy'])->name('destroy');
        Route::patch('/{id}/status', [CollectorsController::class, 'updateStatus'])->name('updateStatus');
    });

    /*
    |--------------------------------------------------------------------------
    | Merchants
    |--------------------------------------------------------------------------
    */
    Route::prefix('lawyer/merchant')->name('lawyer.merchant.')->group(function () {
        Route::get('/', [MerchantController::class, 'index'])->name('index');
        Route::patch('/{id}/status', [MerchantController::class, 'updateStatus'])->name('updateStatus');
        Route::get('/{id}/show', [MerchantController::class, 'show'])->name('show');

        Route::post('/{id}/send-contract', [MerchantController::class, 'sendContract'])->name('sendContract');
    });

    // Single route outside prefix for destroy (plural path)
    Route::delete('/lawyer/merchants/{merchant}', [MerchantController::class, 'destroy'])
        ->name('lawyer.merchants.destroy');

    /*
    |--------------------------------------------------------------------------
    | Follow Ups (Create / Update)
    |--------------------------------------------------------------------------
    */
    Route::prefix('lawyer/followups')->name('lawyer.followups.')->group(function () {
        Route::post('/store', [FollowUpController::class, 'store'])->name('store');
        Route::post('/update/{id}', [FollowUpController::class, 'update'])->name('update');
    });

    /*
    |--------------------------------------------------------------------------
    | Collections
    |--------------------------------------------------------------------------
    */
    Route::prefix('lawyer/collections')->name('lawyer.collections.')->group(function () {
        Route::post('/store', [CollectionsCollections::class, 'store'])->name('store');
        Route::post('/upload-tanfeed', [CollectionsCollections::class, 'uploadTanfeed'])->name('uploadTanfeed');
    });

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */
    Route::get('/lawyer/settings', [SettingsController::class, 'index'])
        ->name('lawyer.settings.index');

    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    */
    Route::prefix('lawyer')->group(function () {
        Route::get('/notifications', [NotificationController::class, 'index'])
            ->name('lawyer.settings.notifications');
        Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])
            ->name('notifications.markAllRead');
    });
});
