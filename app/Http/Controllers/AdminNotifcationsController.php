<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminNotificationsController extends Controller
{
    // GET /adminnotifies
    public function index()
    {
        return response()->json([
            'message' => 'GET /adminnotifies – empfangen (Demo)',
            'notifies' => [
                [
                    'title' => 'Test-Benachrichtigung',
                    'type' => 'info',
                    'created_at' => now()->toIso8601String()
                ]
            ],
            'notifyCount' => 1
        ]);
    }
}
