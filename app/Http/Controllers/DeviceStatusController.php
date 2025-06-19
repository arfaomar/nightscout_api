<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceStatusController extends Controller
{
    // GET /devicestatus
    public function index()
{
    $file = storage_path('debug/devicestatus.json');

    if (!file_exists($file)) {
        return response()->json([
            'message' => 'Noch keine DeviceStatus-Daten vorhanden.',
            'devicestatus' => []
        ]);
    }

    $devicestatus = json_decode(file_get_contents($file), true);

    return response()->json([
        'message' => 'Alle DeviceStatus aus Datei',
        'devicestatus' => $devicestatus
    ]);
}


    // POST /devicestatus
    public function store(Request $request)
{
    $data = $request->all();
    $file = storage_path('debug/devicestatus.json');

    // Falls Datei nicht existiert, leeres Array schreiben
    if (!file_exists($file)) {
        file_put_contents($file, json_encode([]));
    }

    // Bestehende Daten laden
    $existing = json_decode(file_get_contents($file), true) ?? [];

    // Neue Daten anhängen
    if (is_array($data) && isset($data[0])) {
        $existing = array_merge($existing, $data);
    } else {
        $existing[] = $data;
    }

    // Speichern
    file_put_contents($file, json_encode($existing, JSON_PRETTY_PRINT));

    return response()->json([
        'message' => 'DeviceStatus gespeichert',
        'received_count' => is_array($data) ? count($data) : 1
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
