<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminNotificationsController;
use App\Http\Controllers\AlexaController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\DeviceStatusController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\ExperimentsController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\GoogleHomeController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RootController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\VerifyAuthController;
use Illuminate\Support\Facades\Route;

// This group applies the ApiAuthMiddleware to all routes defined within it
Route::group(['middleware' => ['apiAuth']], function () {
    // Entries
    Route::get('/entries', [EntryController::class, 'index']);
    Route::get('/entries/current', [EntryController::class, 'current']);
    Route::get('/entries/{spec}', [EntryController::class, 'show']);
    Route::post('/entries', [EntryController::class, 'store']);
    Route::post('/entries/preview', [EntryController::class, 'preview']);
    Route::delete('/entries/{spec}', [EntryController::class, 'destroySpec']);
    Route::delete('/entries', [EntryController::class, 'destroy']);

    // Treatments
    Route::get('/treatments', [TreatmentController::class, 'index']);
    Route::get('/treatments/{spec}', [TreatmentController::class, 'show']);
    Route::post('/treatments', [TreatmentController::class, 'store']);
    Route::put('/treatments', [TreatmentController::class, 'update']);
    Route::delete('/treatments', [TreatmentController::class, 'destroy']);
    Route::delete('/treatments/{spec}', [TreatmentController::class, 'destroySpec']);

    // Profile
    Route::get('/profiles', [ProfileController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::get('/profile/current', [ProfileController::class, 'current']);
    Route::post('/profile', [ProfileController::class, 'store']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy']);

    // DeviceStatus
    Route::get('/devicestatus', [DeviceStatusController::class, 'index']);
    Route::post('/devicestatus', [DeviceStatusController::class, 'store']);
    Route::delete('/devicestatus', [DeviceStatusController::class, 'destroy']);
    Route::delete('/devicestatus/{spec}', [DeviceStatusController::class, 'destroySpec']);

    // Activity
    Route::get('/activity', [ActivityController::class, 'index']);
    Route::post('/activity', [ActivityController::class, 'store']);
    Route::delete('/activity/{id}', [ActivityController::class, 'destroy']);
    Route::put('/activity', [ActivityController::class, 'update']);

    // Admin Notifications
    Route::get('/adminnotifies', [AdminNotificationsController::class, 'index']);

    // Alexa
    Route::post('/alexa', [AlexaController::class, 'handle']);

    // Experiments
    Route::get('/test', [ExperimentsController::class, 'test']);

    // Food
    Route::get('/food', [FoodController::class, 'index']);
    Route::get('/food/quickpicks', [FoodController::class, 'quickpicks']);
    Route::get('/food/regular', [FoodController::class, 'regular']);
    Route::post('/food', [FoodController::class, 'store']);
    Route::put('/food', [FoodController::class, 'update']);
    Route::delete('/food/{id}', [FoodController::class, 'destroy']);

    // Google Home
    Route::post('/googlehome', [GoogleHomeController::class, 'handle']);

    // Notifications
    Route::post('/notifications/pushovercallback', [NotificationsController::class, 'pushoverCallback']);
    Route::get('/notifications/ack', [NotificationsController::class, 'ack']);

    // Root API
    Route::get('/versions', [RootController::class, 'versions']);

    // VerifyAuth
    Route::get('/verifyauth', [VerifyAuthController::class, 'index']);
});

// Public API Routes
// Request Auth
Route::get('/v2/authorization/request/{apiSecret}', [AuthorizationController::class, 'requestToken']);
Route::get('/v2/authorization/request/token={apiSecret}', [AuthorizationController::class, 'requestToken']);

// Status
Route::get('/status', [StatusController::class, 'index']);
