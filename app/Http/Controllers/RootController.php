<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RootController extends Controller
{
    // GET /versions
    public function versions()
    {
        return response()->json([
            ['version' => 'v1', 'url' => '/api/v1'],
            ['version' => 'v2', 'url' => '/api/v2'],
            ['version' => 'v3', 'url' => '/api/v3']
        ]);
    }
}
