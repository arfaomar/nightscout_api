<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlexaController extends Controller
{
    // POST /alexa
    public function handle(Request $request)
    {
        return response()->json([
            'message' => 'POST /alexa – empfangen (Demo)',
            'received' => $request->all(),
            'response' => [
                'response' => [
                    'outputSpeech' => [
                        'type' => 'PlainText',
                        'text' => 'Glukosewert ist 120 mg/dl'
                    ],
                    'shouldEndSession' => true
                ],
                'version' => '1.0'
            ]
        ]);
    }
}
