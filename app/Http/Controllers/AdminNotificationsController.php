<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminNotificationsController extends Controller
{
    // GET /adminnotifies
    public function index(Request $request)
    {
        return response()->json([
            'status' => 200,
            'message' => [
                'notifies' => [],
                'notifyCount' => 2,
            ],
        ]);
    }
}
