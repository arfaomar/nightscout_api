<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    // GET /treatments
    public function index()
{
    $file = storage_path('debug/treatments.json');

    if (!file_exists($file)) {
        return response()->json([
            'message' => 'Noch keine Treatments vorhanden.',
            'treatments' => []
        ]);
    }

    $treatments = json_decode(file_get_contents($file), true);

    return response()->json([
        'message' => 'Alle Treatments aus Datei',
        'treatments' => $treatments
    ]);
}

    // POST /treatments
    public function store(Request $request)
{
    $data = $request->all();

    $file = storage_path('debug/treatments.json');

    if (!file_exists($file)) {
        file_put_contents($file, json_encode([]));
    }

    $existing = json_decode(file_get_contents($file), true) ?? [];


    if (is_array($data) && isset($data[0])) {
        $existing = array_merge($existing, $data);
    } else {
        $existing[] = $data;
    }

    file_put_contents($file, json_encode($existing, JSON_PRETTY_PRINT));

    return response()->json([
        'message' => 'Behandlung(en) gespeichert (temporär)',
        'count' => count($existing)
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
    public function destroySpec($spec)
    {
        return response()->json([
            'message' => "DELETE request angekommen bei /treatments/$spec (Demo)",
            'spec' => $spec
        ]);
    }
}
