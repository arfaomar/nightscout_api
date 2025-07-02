<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    // POST /notifications/pushovercallback
    public function pushoverCallback(Request $request)
    {
        return response()->json([
            'message' => 'POST /notifications/pushovercallback received',
            'received' => $request->all()
        ]);
    }

    // GET /notifications/ack
    public function ack(Request $request)
    {
        return response()->json([
            'status' => 'OK'
        ]);
    }
}
