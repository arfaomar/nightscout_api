<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    // POST /notifications/pushovercallback
    public function pushoverCallback(Request $request)
    {
        return response()->json([
            'message' => 'POST /notifications/pushovercallback – empfangen (Demo)',
            'received' => $request->all()
        ]);
    }

    // GET /notifications/ack
    public function ack(Request $request)
    {
        return response()->json([
            'message' => 'GET /notifications/ack – Benachrichtigung bestätigt (Demo)',
            'status' => 'acknowledged'
        ]);
    }
}
