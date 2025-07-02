<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyAuthController extends Controller
{
    // GET /verifyauth
    public function index()
    {
        return response()->json([
            'status' => 200,
            'message' => [
                'canRead' => true,
                'canWrite' => true,
                'isAdmin' => true,
                'message' => 'OK',
                'rolefound' => 'FOUND',
                'permissions' => 'ROLE'
            ]
        ]);
    }
}
