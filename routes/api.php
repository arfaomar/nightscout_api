<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntryController;

Route::middleware('api')->group(function () {
    Route::post('/entries', [EntryController::class, 'store']);
});
