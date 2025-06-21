<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleHomeController extends Controller
{
    // POST /googlehome
    public function handle(Request $request)
    {
        return response()->json([
            'message' => 'POST /googlehome – empfangen (Demo)',
            'received' => $request->all(),
            'response' => [
                'speech' => 'Der aktuelle Glukosewert beträgt 120 mg/dl.',
                'displayText' => 'Glukosewert: 120 mg/dl',
                'source' => 'Laravel-Demo-API'
            ]
        ]);
    }
}
