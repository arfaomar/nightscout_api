<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\TreatmentController;


// Alle Entries (Demo)
Route::get('/entries', [EntryController::class, 'index']);

// Einzelner Eintrag/Filter (Demo mit Spec)
Route::get('/entries/{spec}', [EntryController::class, 'show']);

// Neues Entry anlegen (Demo, Daten von AndroidAPS)
Route::post('/entries', [EntryController::class, 'store']);


Route::get('/treatments', [TreatmentController::class, 'index']);
Route::post('/treatments', [TreatmentController::class, 'store']);