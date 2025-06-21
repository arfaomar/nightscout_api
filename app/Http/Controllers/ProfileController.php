<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // GET /profile
    public function index()
    {
        return response()->json([
            'message' => 'GET /profile – Profil angezeigt (Demo)',
            'profile' => [
                'defaultProfile' => 'Standard',
                'store' => [
                    'Standard' => [
                        'basal' => [
                            ['time' => '00:00', 'value' => 1.0],
                            ['time' => '06:00', 'value' => 0.9]
                        ],
                        'carbratio' => 10,
                        'sens' => 50
                    ]
                ]
            ]
        ]);
    }

    // GET /profile/current
    public function current()
    {
        return response()->json([
            'message' => 'GET /profile/current – aktuelles Profil (Demo)',
            'profile' => 'Standard'
        ]);
    }

    // GET /profiles
    public function list()
    {
        return response()->json([
            'message' => 'GET /profiles – Liste aller Profile (Demo)',
            'profiles' => ['Standard', 'Sport', 'Krank']
        ]);
    }

    // POST /profile
    public function store(Request $request)
    {
        $data = $request->all();

        $file = storage_path('debug/profile.json');

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
            'message' => 'Profile gespeichert (temporär)',
            'count' => count($existing)
        ]);
    }

    // PUT /profile
    public function update(Request $request)
    {
        return response()->json([
            'message' => 'PUT /profile – aktualisiert (Demo)',
            'updated' => $request->all()
        ]);
    }

    // DELETE /profile/{id}
    public function destroy($id)
    {
        return response()->json([
            'message' => "DELETE /profile/$id – gelöscht (Demo)"
        ]);
    }
}
