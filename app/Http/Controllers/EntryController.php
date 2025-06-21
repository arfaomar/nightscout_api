<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntryController extends Controller
{
    // GET /entries
    public function index()
    {
        return response()->json([
            'message' => 'GET /entries – alle Einträge (Demo)',
            'entries' => [
                [
                    '_id' => 'abc123',
                    'type' => 'sgv',
                    'sgv' => 120,
                    'date' => now()->timestamp * 1000,
                    'dateString' => now()->toIso8601String()
                ]
            ]
        ]);
    }

    // GET /entries/{spec}
    public function show($spec)
    {
        return response()->json([
            'message' => "GET /entries/$spec – Eintrag anzeigen (Demo)",
            'entry' => [
                '_id' => $spec,
                'type' => 'sgv',
                'sgv' => 130
            ]
        ]);
    }

    // GET /entries/current
    public function current()
    {
        return response()->json([
            'message' => 'GET /entries/current – aktueller Eintrag (Demo)',
            'entry' => [
                '_id' => 'current123',
                'sgv' => 125,
                'date' => now()->timestamp * 1000
            ]
        ]);
    }

    // POST /entries
    public function store(Request $request)
    {
        return response()->json([
            'message' => 'POST /entries – empfangen (Demo)',
            'received' => $request->all()
        ]);
    }

    // POST /entries/preview
    public function preview(Request $request)
    {
        return response()->json([
            'message' => 'POST /entries/preview – validiert (Demo)',
            'validated' => $request->all()
        ]);
    }

    // DELETE /entries/{spec}
    public function destroySpec($spec)
    {
        return response()->json([
            'message' => "DELETE /entries/$spec – gelöscht (Demo)"
        ]);
    }

    // DELETE /entries
    public function destroy(Request $request)
    {
        return response()->json([
            'message' => 'DELETE /entries – per Filter gelöscht (Demo)',
            'filter' => $request->query('find', [])
        ]);
    }
}
