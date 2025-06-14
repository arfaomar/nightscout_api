<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceStatusController extends Controller
{
    // GET /devicestatus
    public function index()
    {
        // The query used to find entries
        $find = request()->query('find', []);
        //Number of devicestatus records to return.
        $count = request()->query('count', null);
        return response()->json([
            'message' => 'GET /devicestatus (Demo)',
            'find' => $find,
            'count' => $count,
        ]);
    }

    // POST /devicestatus
    public function store(Request $request)
    {
        return response()->json([
            'message' => 'POST request angekommen bei /devicestatus (Demo)',
            'received' => $request->all()
        ]);
    }

    // DELETE /devicestatus
    public function destroy(Request $request)
    {
        // The query usetd to find entries
        $find = $request->query('find', []);
        return response()->json([
            'message' => 'DELETE request angekommen bei /devicestatus (Demo)',
            'find' => $find
        ]);
    }

    // DELETE /devicestatus/{spec}
    public function destroySpec($spec)
    {
        return response()->json([
            'message' => "DELETE request angekommen für /devicestatus/$spec (Demo)",
            'spec' => $spec
        ]);
    }
}
