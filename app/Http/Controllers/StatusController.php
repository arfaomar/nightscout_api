<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    // GET /status
    public function index()
    {
        return response()->json([
            'message' => 'GET /status (Demo)',
            'status' => 'ok'
        ]);
    }
}
