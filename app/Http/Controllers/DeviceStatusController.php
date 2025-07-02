<?php

namespace App\Http\Controllers;

use App\Models\DeviceStatus;
use Illuminate\Http\Request;
use App\Helpers\QueryHelper;
use Illuminate\Support\Facades\Log;

class DeviceStatusController extends Controller
{
    // GET /devicestatus
    public function index(Request $request)
    {
        $query = DeviceStatus::query();
        $find = $request->query('find', []);
        QueryHelper::applyNightscoutFind($query, $find);

        $count = $request->query('count');
        QueryHelper::applyCount($query, $count);

        $statuses = $query->get();

        return response()->json($statuses);
    }



    // POST /devicestatus
    public function store(Request $request)
    {
        $data = $request->all();

        if (is_array($data) && isset($data[0])) {
            $data = $data[0];
        }

        if (!isset($data['_id'])) {
            $data['_id'] = bin2hex(random_bytes(12));
        }

        if (isset($data['created_at'])) {
            $data['created_at'] = \Carbon\Carbon::parse($data['created_at'])->format('Y-m-d H:i:s');
        }

        foreach (['pump', 'openaps', 'configuration', 'loop', 'uploader', 'xdripjs'] as $jsonField) {
            if (isset($data[$jsonField])) {
                if (empty($data[$jsonField]) || $data[$jsonField] === "") {
                    $data[$jsonField] = null;
                }
            }
        }

        $fixedFields = [
            '_id',
            'device',
            'created_at',
            'openaps',
            'loop',
            'uploaderBattery',
            'isCharging',
            'configuration',
            'pump',
            'uploader',
            'xdripjs'
        ];

        $extra = collect($data)->except($fixedFields)->toArray();
        $main = collect($data)->only($fixedFields)->toArray();

        $main['extra_data'] = $extra;

        $status = DeviceStatus::create($main);

        return response()->json([
            'message' => 'DeviceStatus saved',
            'id' => $status->_id,
        ], 201);
    }



    // DELETE /devicestatus
    public function destroy(Request $request)
    {
        $query = DeviceStatus::query();
        $find = $request->query('find', []);
        QueryHelper::applyNightscoutFind($query, $find);

        $count = $query->count();
        if ($count === 0) {
            return response()->json([
                'message' => 'No matching DeviceStatus found. Nothing deleted.',
                'deleted' => 0
            ], 404);
        }

        $deleted = $query->delete();

        return response()->json([
            'message' => 'DeviceStatus deleted',
            'deleted' => $deleted
        ]);
    }


    // DELETE /devicestatus/{spec}
    public function destroySpec($spec)
    {
        $status = DeviceStatus::find($spec);
        if (!$status) {
            return response()->json(['message' => 'DeviceStatus not found'], 404);
        }
        $status->delete();
        return response()->json([
            'message' => 'DeviceStatus deleted',
            'id' => $spec
        ]);
    }
}
