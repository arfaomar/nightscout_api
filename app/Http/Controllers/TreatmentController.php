<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    // GET /treatments
    public function index()
    {
        // The query used to find entries
        $find = request()->query('find', []);
        // Number of entries to return.
        $count = request()->query('count', null);
        return response()->json([
            'message' => 'Alle Treatments abgerufen (Demo)',
            'find' => $find,
            'count' => $count,
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
    // DELETE /treatments
    public function destroy(Request $request)
    {
        // The query used to find treatments
        $find = $request->query('find', []);
        // Number of treatments to return.
        $count = $request->query('count', null);

        return response()->json([
            'message' => 'DELETE request angekommen bei /treatments (Demo)',
            'find' => $find,
            'count' => $count
        ]);
    }
    // DELETE /treatments/{spec}
    public function destroySpec($spec){
        return response()->json([
            'message' => "DELETE request angekommen bei /treatments/$spec (Demo)",
            'spec' => $spec
        ]);
    }
}
