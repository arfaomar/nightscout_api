<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // GET /profile
    public function index()
    {
        return response()->json([
            'message' => 'GET /profile (Demo)',
            'profile' => [
                'units' => 'mg/dl',
                'target_low' => 90,
                'target_high' => 130
            ]
        ]);
    }
}
