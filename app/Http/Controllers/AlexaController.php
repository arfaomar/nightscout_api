<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlexaController extends Controller
{
    // POST /alexa
    public function handle(Request $request)
    {
        $body = $request->all();

        $type = $body['request']['type'] ?? null;

        if ($type === 'IntentRequest') {
            $intent = $body['request']['intent']['name'] ?? '';

            if ($intent === 'GetGlucoseIntent') {
                $glucose = 140;
                $msg = "Your current glucose is {$glucose} milligrams per deciliter.";

                return response()->json([
                    'version' => '1.0',
                    'response' => [
                        'outputSpeech' => [
                            'type' => 'PlainText',
                            'text' => $msg,
                        ],
                        'shouldEndSession' => true,
                    ]
                ]);
            }
        }

        return response()->json([
            'version' => '1.0',
            'response' => [
                'outputSpeech' => [
                    'type' => 'PlainText',
                    'text' => 'Sorry, I did not understand your request.',
                ],
                'shouldEndSession' => true,
            ]
        ]);
    }
}
