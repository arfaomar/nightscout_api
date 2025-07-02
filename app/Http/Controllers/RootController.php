<?php

namespace App\Http\Controllers;

class RootController extends Controller
{
    // GET /versions
    public function versions()
    {
        return response()->json([
            ['version' => '1.0.0', 'url' => '/api/v1'],
            ['version' => '2.0.0', 'url' => '/api/v2'],
            ['version' => '3.0.3-alpha', 'url' => '/api/v3'],
        ]);
    }
}
