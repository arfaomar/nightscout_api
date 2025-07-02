<?php

namespace App\Http\Controllers;

use App\Helpers\QueryHelper;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    // GET /activity
    public function index(Request $request)
    {
        $query = Activity::query();
        $find = $request->query('find', []);
        QueryHelper::applyNightscoutFind($query, $find);

        $count = $request->query('count');
        QueryHelper::applyCount($query, $count);

        $activities = $query->get();

        return response()->json($activities);
    }

    // POST /activity
    public function store(Request $request)
    {
        $data = $request->all();
        if (is_array($data) && isset($data[0])) {
            $results = [];
            foreach ($data as $item) {
                if (! isset($item['_id'])) {
                    $item['_id'] = bin2hex(random_bytes(12));
                }
                if (isset($item['created_at'])) {
                    $item['created_at'] = \Carbon\Carbon::parse($item['created_at'])->format('Y-m-d H:i:s');
                }
                $fixedFields = [
                    '_id',
                    'eventType',
                    'duration',
                    'created_at',
                    'notes',
                    'enteredBy',
                ];
                $extra = collect($item)->except($fixedFields)->toArray();
                $main = collect($item)->only($fixedFields)->toArray();
                $main['extra_data'] = $extra;
                $results[] = Activity::create($main);
            }

            return response()->json($results, 201);
        } else {
            if (! isset($data['_id'])) {
                $data['_id'] = bin2hex(random_bytes(12));
            }
            if (isset($data['created_at'])) {
                $data['created_at'] = \Carbon\Carbon::parse($data['created_at'])->format('Y-m-d H:i:s');
            }
            $fixedFields = [
                '_id',
                'eventType',
                'duration',
                'created_at',
                'notes',
                'enteredBy',
            ];
            $extra = collect($data)->except($fixedFields)->toArray();
            $main = collect($data)->only($fixedFields)->toArray();
            $main['extra_data'] = $extra;
            $activity = Activity::create($main);

            return response()->json($activity, 201);
        }
    }

    // PUT /activity
    public function update(Request $request)
    {
        $data = $request->all();
        if (! isset($data['_id'])) {
            return response()->json(['message' => 'Missing _id'], 400);
        }

        $activity = Activity::find($data['_id']);
        if (! $activity) {
            return response()->json(['message' => 'Activity not found'], 404);
        }

        $fixedFields = [
            '_id',
            'eventType',
            'duration',
            'created_at',
            'notes',
            'enteredBy',
        ];
        $extra = collect($data)->except($fixedFields)->toArray();
        $main = collect($data)->only($fixedFields)->toArray();
        $main['extra_data'] = $extra;

        $activity->update($main);

        return response()->json($activity);
    }

    // DELETE /activity/{_id}
    public function destroy($id)
    {
        $activity = Activity::find($id);
        if (! $activity) {
            return response()->json(['message' => 'Activity not found'], 404);
        }
        $activity->delete();

        return response()->json(['message' => 'Activity deleted', 'id' => $id]);
    }
}
