<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\LandingPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Merchant\CompanyProfileController;
use App\Http\Controllers\Merchant\DashboardController;
use App\Http\Controllers\Merchant\ComplaintController;
use App\Http\Controllers\Merchant\FollowUpController;
use App\Http\Controllers\Merchant\CollectionsCollections;
use App\Http\Controllers\Merchant\SettingsController;
use App\Http\Controllers\Merchant\NotificationController;
use App\Http\Controllers\Merchant\ContractController;
use App\Http\Controllers\ContactController;



/*
     |--------------------------------------------------------------------------
     | Public Routes
     |--------------------------------------------------------------------------
     */

Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/license', [LandingPageController::class, 'license'])->name('license');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

/*
     |--------------------------------------------------------------------------
     | Contract Upload (No Middleware)
     |--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/contract/upload', [ContractController::class, 'index'])->name('contract.upload');
    Route::post('/contract/upload', [ContractController::class, 'store'])->name('contract.store');
});

/*
     |--------------------------------------------------------------------------
     | Authenticated Merchant Routes (Partially Protected)
     |--------------------------------------------------------------------------
     | Routes that require the user to be authenticated and have merchant role,
     | but not necessarily verified.
     */
Route::middleware(['auth'])->group(function () {
    Route::get('/errors/not-active', [DashboardController::class, 'notactive'])->name('not-active');
});

/*
     |--------------------------------------------------------------------------
     | Verified Merchant Routes
     |--------------------------------------------------------------------------
     | Routes that require authentication, email verification, and merchant role.
     */
Route::middleware(['auth', 'verified', 'merchant'])->group(function () {

    /*
    |----------------------------------------------------------------------
    | Dashboard
    |----------------------------------------------------------------------
    */
    Route::get('/merchant/dashboard', [DashboardController::class, 'index'])
        ->name('merchant.dashboard');

    /*
    |----------------------------------------------------------------------
    | Complaints
    |----------------------------------------------------------------------
    */
    Route::prefix('merchant/complaints')->name('merchant.complaints.')->group(function () {
        Route::get('/', [ComplaintController::class, 'index'])->name('index');
        Route::get('/create', [ComplaintController::class, 'create'])->name('create');
        Route::post('/store', [ComplaintController::class, 'store'])->name('store');
        Route::get('/{id}/show', [ComplaintController::class, 'show'])->name('show');
        Route::post('/import', [ComplaintController::class, 'import'])->name('import');
        Route::get('/pending', [ComplaintController::class, 'pending'])->name('pending');
        Route::get('/{id}/followup', [FollowUpController::class, 'index'])->name('followup');
        Route::get('/{id}/collections', [CollectionsCollections::class, 'index'])->name('collections');

        Route::post('/{complaint}/attachments', [ComplaintController::class, 'attachments_store'])
            ->name('attachments.store');
    });

    /*
    |----------------------------------------------------------------------
    | Settings
    |----------------------------------------------------------------------
    */
    Route::get('/merchant/settings', [SettingsController::class, 'index'])
        ->name('merchant.settings.index');


    /*
    |----------------------------------------------------------------------
    | Notifications
    |----------------------------------------------------------------------
    */
    Route::prefix('merchant')->group(function () {
        Route::get('/notifications', [NotificationController::class, 'index'])
            ->name('merchant.settings.notifications');
        // Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])
        //     ->name('notifications.markAllRead');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/lawyer.php';
require __DIR__ . '/collector.php';
require __DIR__ . '/auth.php';
