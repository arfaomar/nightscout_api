<?php

namespace App\Http\Controllers;

class ExperimentsController extends Controller
{
    // GET /test
    public function test()
    {
        return response()->json([
            'status' => 'ok',
        ]);
    }
}
