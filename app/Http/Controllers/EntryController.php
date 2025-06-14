<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntryController extends Controller
{
    // GET /entries
    public function index()
    {
        // The query used to find entries
        $find = request()->query('find', []);
        // Number of entries to return.
        $count = request()->query('count', null);
        return response()->json([
            'message' => 'Alle Entries abgerufen (Demo)',
            'find' => $find,
            'count' => $count,
            'demo_entries' => [
                [
                    "type" => "sgv",
                    "dateString" => "2024-06-01T19:20:00Z",
                    "date" => 1747573200000,
                    "sgv" => 140,
                ],
                [
                    "type" => "mbg",
                    "dateString" => "2024-06-01T19:30:00Z",
                    "date" => 1747573800000,
                    "sgv" => 150,
                ]
            ]
        ]);
    }
    // GET /entries/{spec}
    public function show($spec)
    {
        // The query used to find entries
        $find = request()->query('find', []);
        // Number of entries to return.
        $count = request()->query('count', null);
        return response()->json([
            'message' => "Entry abgerufen für Spec: '$spec'",
            'entry' => [
                "type" => $spec,
                "dateString" => "2024-06-01T19:20:00Z",
                "date" => 1747573200000,
                "sgv" => $spec === 'sgv' ? 140 : null,
            ]
        ]);
    }
    // POST /entries
    public function store(Request $request)
    {
        return response()->json([
            'message' => 'POST request angekommen bei /entries (Demo)',
            'received' => $request->all()
        ]);
    }
    // DELETE /entries
    public function destroy(Request $request)
    {
        //The query used to find entries
        $find = $request->query('find', []);
        // Number of entries to return.
        $count = $request->query('count', null);

        return response()->json([
            'message' => 'DELETE request angekommen bei /entries (Demo)',
            'find' => $find,
            'count' => $count,
        ]);
    }
}
