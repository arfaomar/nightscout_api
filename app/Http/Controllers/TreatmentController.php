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
                'message' => 'No treatments found',
                'count' => 0,
                'treatments' => []
            ]);
        }

        return response()->json([
            'message' => 'All treatments loaded',
            'count' => $treatments->count(),
            'treatments' => $treatments
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
            'message' => 'Treatments saved',
            'count' => $count
        ]);
    }

    // PUT /treatments 
    public function update(Request $request)
    {
        $data = $request->all();
        $count = 0;

        if (isset($data['_id'])) {
            $treatment = Treatment::where('_id', $data['_id'])->first();

            if ($treatment) {
                $treatment->update($data);
                $message = 'Treatment updated';
                $count = 1;
            } else {
                Treatment::create($data);
                $message = 'New treatment created';
                $count = 1;
            }
        } else {
            $data['_id'] = bin2hex(random_bytes(12));
            Treatment::create($data);
            $message = 'New treatment created (with generated _id)';
            $count = 1;
        }

        return response()->json([
            'message' => $message,
            'count' => $count,
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

        $count = $query->delete();

        if ($count === 0) {
            return response()->json([
                'message' => 'No matching treatments found. Nothing deleted',
                'count' => 0,
                ], 
                404);
        }

        return response()->json([
            'message' => 'Treatments deleted',
            'count' => $count
        ]);
    }

    // DELETE /treatments/{spec}
    public function destroySpec($spec)
    {
        $treatment = Treatment::where('_id', $spec)->first();

        if (!$treatment) {
            return response()->json(['message' => 'Treatment not found',
                'count' => 0,
                'treatment' => null
            ], 404);
        }

        $count = $treatment->delete();

        return response()->json([
            'message' => "Treatment with ID: $spec deleted",
            'count' => $count,
            'id' => $spec
        ]);
    }
}
