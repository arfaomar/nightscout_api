<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;

class TreatmentController extends Controller
{
    // GET /treatments
    public function index()
    {
        $treatments = Treatment::all();

        if ($treatments->isEmpty()) {
            return response()->json([
                'message' => 'Keine Treatments gefunden',
                'treatments' => []
            ]);
        }

        return response()->json([
            'message' => 'Alle Treatments geladen',
            'treatments' => $treatments
        ]);
    }

    // GET /treatments/{spec} 
    public function show($spec)
    {
        $treatment = Treatment::find($spec);

        if (!$treatment) {
            return response()->json(['message' => 'Treatment nicht gefunden'], 404);
        }

        return response()->json([
            'message' => "Einzelnes Treatment geladen",
            'treatment' => $treatment
        ]);

    }

    // POST /treatments
    public function store(Request $request)
    {
        $data = $request->all();
        $count = 0;

        if (is_array($data) && isset($data[0])) {
            foreach ($data as &$entry) {
                $entry['_id'] = bin2hex(random_bytes(12));
                Treatment::create($entry);
                $count++;
            }
        } else {
            $data['_id'] = bin2hex(random_bytes(12));
            Treatment::create($data);
            $count = 1;
        }

        return response()->json([
            'message' => 'Behandlung(en) gespeichert',
            'count' => $count
        ]);
    }

    // PUT /treatments 
   public function update(Request $request)
    {
        $data = $request->all();

        if (isset($data['_id'])) {
            $treatment = Treatment::where('_id', $data['_id'])->first();

            if ($treatment) {
                $treatment->update($data);
                $message = 'Treatment aktualisiert';
            } else {
                Treatment::create($data);
                $message = 'Treatment neu angelegt';
            }
        } else {
            $data['_id'] = bin2hex(random_bytes(12));
            Treatment::create($data);
            $message = 'Treatment neu angelegt (mit generierter _id)';
        }

        return response()->json([
            'message' => $message,
            'treatment' => $data
        ]);
    }

    // DELETE /treatments
    public function destroy(Request $request)
    {
        $find = $request->query('find', []);
        $query = Treatment::query();

        foreach ($find as $field => $condition) {
            if (is_array($condition)) {
                foreach ($condition as $op => $value) {
                    switch ($op) {
                        case '$lt':
                            $query->where($field, '<', $value);
                            break;
                        case '$lte':
                            $query->where($field, '<=', $value);
                            break;
                        case '$gt':
                            $query->where($field, '>', $value);
                            break;
                        case '$gte':
                            $query->where($field, '>=', $value);
                            break;
                    }
                }
            } else {
                $query->where($field, $condition);
            }
        }

        $deleted = $query->delete();

        if ($deleted === 0) {
            return response()->json([
                'message' => 'Keine passenden Treatments gefunden. Nichts gelöscht.',
                'deleted' => 0], 
                404);
        }

        return response()->json([
            'message' => 'Treatments gelöscht',
            'deleted' => $deleted
        ]);
    }


    // DELETE /treatments/{spec}
    public function destroySpec($spec)
    {
        $treatment = Treatment::where('_id', $spec)->first();

        if (!$treatment) {
            return response()->json(['message' => 'Treatment nicht gefunden'], 404);
        }

        $treatment->delete();

        return response()->json([
            'message' => "Treatment mit der ID: $spec geloescht",
            'id' => $spec
        ]);

    }
    
}
