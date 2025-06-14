<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\DeviceStatusController;

// Entries
Route::get('/entries', [EntryController::class, 'index']);
Route::get('/entries/{spec}', [EntryController::class, 'show']);
Route::post('/entries', [EntryController::class, 'store']);
Route::delete('/entries', [EntryController::class, 'destroy']);

// Treatments
Route::get('/treatments', [TreatmentController::class, 'index']);
Route::post('/treatments', [TreatmentController::class, 'store']);
Route::delete('/treatments', [TreatmentController::class, 'destroy']);
Route::delete('/treatments/{spec}', [TreatmentController::class, 'destroySpec']);

// Profile
Route::get('/profile', [ProfileController::class, 'index']);

// Status
Route::get('/status', [StatusController::class, 'index']);

// DeviceStatus
Route::get('/devicestatus', [DeviceStatusController::class, 'index']);
Route::post('/devicestatus', [DeviceStatusController::class, 'store']);
Route::delete('/devicestatus', [DeviceStatusController::class, 'destroy']);
Route::delete('/devicestatus/{spec}', [DeviceStatusController::class, 'destroySpec']);
