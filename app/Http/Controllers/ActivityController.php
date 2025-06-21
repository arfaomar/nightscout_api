<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
      // GET /activity
    public function index()
    {
        return response()->json([
            'message' => 'GET /activity – alle Aktivitäten (Demo)',
            'activities' => [
                [
                    '_id' => 'demo123',
                    'eventType' => 'Exercise',
                    'duration' => 30,
                    'created_at' => '2025-06-19T10:00:00Z'
                ]
            ]
        ]);
    }

    // POST /activity
    public function store(Request $request)
    {
        return response()->json([
            'message' => 'POST /activity – empfangen (Demo)',
            'received' => $request->all()
        ]);
    }

    // PUT /activity
    public function update(Request $request)
    {
        return response()->json([
            'message' => 'PUT /activity – empfangen (Demo)',
            'received' => $request->all()
        ]);
    }

    // DELETE /activity/{id}
    public function destroy($id)
    {
        return response()->json([
            'message' => "DELETE /activity/$id – empfangen (Demo)",
            'deleted_id' => $id
        ]);
    }
}

