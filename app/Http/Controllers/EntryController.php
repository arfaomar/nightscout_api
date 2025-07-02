<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;
use App\Helpers\QueryHelper;

class EntryController extends Controller
{
    // GET /entries
    public function index(Request $request)
    {
        $query = Entry::query();
        $find = $request->query('find', []);
        QueryHelper::applyNightscoutFind($query, $find);

        $count = $request->query('count');
        QueryHelper::applyCount($query, $count);

        $entries = $query->get();

        return response()->json($entries);
    }

    // POST /entries
    public function store(Request $request)
    {
        $data = $request->all();

        if (is_array($data) && isset($data[0])) {
            $data = $data[0];
        }

        if (!isset($data['_id'])) {
            $data['_id'] = bin2hex(random_bytes(12));
        }

        if (isset($data['dateString'])) {
            $data['dateString'] = \Carbon\Carbon::parse($data['dateString'])->format('Y-m-d H:i:s');
        }

        $fixedFields = [
            '_id',
            'created_at',
            'type',
            'dateString',
            'date',
            'sgv',
            'direction',
            'noise',
            'filtered',
            'unfiltered',
            'rssi',
        ];

        $extra = collect($data)->except($fixedFields)->toArray();
        $main = collect($data)->only($fixedFields)->toArray();
        $main['extra_data'] = $extra;

        $entry = Entry::create($main);

        return response()->json([
            'message' => 'Entry saved',
            'id' => $entry->_id ?? $entry->id, 
        ], 201);
    }

    // DELETE /entries
    public function destroy(Request $request)
    {
        $query = Entry::query();
        $find = $request->query('find', []);
        QueryHelper::applyNightscoutFind($query, $find);

        $count = $query->count();
        if ($count === 0) {
            return response()->json([
                'message' => 'No matching entries found. Nothing deleted.',
                'deleted' => 0
            ], 404);
        }

        $deleted = $query->delete();

        return response()->json([
            'message' => 'Entries deleted',
            'deleted' => $deleted
        ]);
    }

    // DELETE /entries/{spec}
    public function destroySpec($spec)
    {
        $entry = Entry::find($spec);
        if (!$entry) {
            return response()->json(['message' => 'Entry not found'], 404);
        }
        $entry->delete();
        return response()->json([
            'message' => 'Entry deleted',
            'id' => $spec
        ]);
    }
    // GET /entries/current
    public function current()
    {
        $entry = Entry::orderByDesc('date')->first();
        if (!$entry) {
            return response()->json(['message' => 'No entry found'], 404);
        }
        return response()->json($entry);
    }
    // GET /entries/{spec}
    public function show($spec)
    {
        $entry = Entry::find($spec);
        if (!$entry) {
            return response()->json(['message' => 'Entry not found'], 404);
        }
        return response()->json($entry);
    }

    // POST /entries/preview
    public function preview(Request $request)
    {
        return response()->json([
            'message' => 'Entries validated (preview)',
            'validated' => $request->all()
        ]);
    }
}
