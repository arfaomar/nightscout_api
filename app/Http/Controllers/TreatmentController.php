<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    // GET /treatments
    public function index()
    {
        return response()->json([
            'message' => 'Alle Treatments abgerufen (Demo)',
            'treatments' => [
                [
                    "eventType" => "BG Check",
                    "created_at" => "2025-05-18T13:09:52.000Z",
                    "glucose" => 200,
                ],
                [
                    "eventType" => "Temp Basal",
                    "created_at" => "2025-05-18T13:28:00.982Z",
                    "rate" => 1.35,
                ]
            ]
        ]);
    }

    // POST /treatments
    public function store(Request $request)
    {
        return response()->json([
            'message' => 'POST request angekommen bei /treatments (Demo)',
            'received' => $request->all()
        ]);
    }
}
