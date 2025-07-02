<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExperimentsController extends Controller
{
    // GET /test
    public function test()
    {
        return response()->json([
            'status' => 'ok'
        ]);
    }
}
