<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleHomeController extends Controller
{
    // POST /googlehome
    public function handle(Request $request)
    {
        $intent = $request->input('queryResult.intent.displayName', 'DefaultIntent');

        $responseText = 'The current glucose value is 120 mg/dl.';
        if ($intent === 'GetInsulinIntent') {
            $responseText = 'Your last insulin intake was 2 units one hour ago.';
        }

        return response()->json([
            'fulfillmentText' => $responseText,
            'source' => 'Laravel-Nightscout-API'
        ]);
    }
}
