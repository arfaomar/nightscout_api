<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treatment;
use App\Helpers\QueryHelper;

class TreatmentController extends Controller
{
    // GET /treatments
    public function index(Request $request)
    {
        $query = Treatment::query();
        $find = $request->query('find', []);
        QueryHelper::applyNightscoutFind($query, $find);

        $count = $request->query('count');
        QueryHelper::applyCount($query, $count);

        $treatments = $query->get();

        return response()->json($treatments);
    }

    // POST /treatments
    public function store(Request $request)
    {
        $data = $request->all();

        if (is_array($data) && isset($data[0])) {
            $responses = [];
            foreach ($data as $item) {
                if (!isset($item['_id'])) {
                    $item['_id'] = bin2hex(random_bytes(12));
                }
                if (isset($item['created_at'])) {
                    $item['created_at'] = \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d H:i:s');
                }
                $fixedFields = [
                    '_id',
                    'eventType',
                    'created_at',
                    'glucose',
                    'glucoseType',
                    'carbs',
                    'protein',
                    'fat',
                    'insulin',
                    'units',
                    'transmitterId',
                    'sensorCode',
                    'notes',
                    'enteredBy'
                ];
                $extra = collect($item)->except($fixedFields)->toArray();
                $main = collect($item)->only($fixedFields)->toArray();
                $main['extra_data'] = $extra;

                $responses[] = Treatment::create($main);
            }
            return response()->json($responses, 201);
        }

        if (!isset($data['_id'])) {
            $data['_id'] = bin2hex(random_bytes(12));
        }
        if (isset($data['created_at'])) {
            $data['created_at'] = \Carbon\Carbon::parse($data['created_at'])->format('Y-m-d H:i:s');
        }
        $fixedFields = [
            '_id',
            'eventType',
            'created_at',
            'glucose',
            'glucoseType',
            'carbs',
            'protein',
            'fat',
            'insulin',
            'units',
            'transmitterId',
            'sensorCode',
            'notes',
            'enteredBy'
        ];
        $extra = collect($data)->except($fixedFields)->toArray();
        $main = collect($data)->only($fixedFields)->toArray();
        $main['extra_data'] = $extra;

        $treatment = Treatment::create($main);

        return response()->json($treatment, 201);
    }


    // PUT /treatments
    public function update(Request $request)
    {
        $data = $request->all();
        if (!isset($data['_id'])) {
            return response()->json(['error' => 'No _id specified'], 400);
        }
        $treatment = Treatment::find($data['_id']);
        if (!$treatment) {
            return response()->json(['error' => 'Treatment not found'], 404);
        }

        // Update Main-Fields
        $fixedFields = [
            '_id',
            'eventType',
            'created_at',
            'glucose',
            'glucoseType',
            'carbs',
            'protein',
            'fat',
            'insulin',
            'units',
            'transmitterId',
            'sensorCode',
            'notes',
            'enteredBy'
        ];
        $main = collect($data)->only($fixedFields)->toArray();
        $extra = collect($data)->except($fixedFields)->toArray();

        $treatment->fill($main);
        $treatment->extra_data = $extra;
        $treatment->save();

        return response()->json($treatment);
    }

    // DELETE /treatments/{id}
    public function destroySpec($id)
    {
        $treatment = Treatment::find($id);
        if (!$treatment) {
            return response()->json(['message' => 'Treatment not found'], 404);
        }
        $treatment->delete();
        return response()->json([
            'message' => 'Treatment deleted',
            'id' => $id
        ]);
    }

    // DELETE /treatments
    public function destroy(Request $request)
    {
        $query = Treatment::query();
        $find = $request->query('find', []);
        QueryHelper::applyNightscoutFind($query, $find);

        $count = $query->count();
        if ($count === 0) {
            return response()->json([
                'message' => 'No matching Treatment found. Nothing deleted.',
                'deleted' => 0
            ], 404);
        }

        $deleted = $query->delete();
        return response()->json([
            'message' => 'Treatments deleted',
            'deleted' => $deleted
        ]);
    }
}
