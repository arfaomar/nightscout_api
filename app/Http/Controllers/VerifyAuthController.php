<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyAuthController extends Controller
{
    // GET /verifyauth
    public function index()
    {
        return response()->json([
            'canRead' => true,
            'canWrite' => true,
            'isAdmin' => false,
            'message' => 'OK',
            'rolefound' => 'FOUND',
            'permissions' => 'ROLE'
        ]);
    }
}
