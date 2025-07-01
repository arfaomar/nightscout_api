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
        Log::info('DeviceStatusController@index called with query: ' . json_encode($request->query()));
        $query = DeviceStatus::query();
        $find = $request->query('find', []);
        QueryHelper::applyNightscoutFind($query, $find);

        $count = $request->query('count');
        QueryHelper::applyCount($query, $count);

        $statuses = $query->get();

        return response()->json($statuses);
    }



    // POST /devicestatus
    // Care i probably need to change it but im not sure atm. It works right now.
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
        $data['created_at'] = \Carbon\Carbon::parse($data['created_at']);
    }

    foreach (['pump', 'openaps', 'configuration', 'loop', 'uploader', 'xdripjs'] as $jsonField) {
        if (isset($data[$jsonField])) {
            if (is_array($data[$jsonField]) && count($data[$jsonField]) === 0) {
                $data[$jsonField] = null;
            }
            if ($data[$jsonField] === "" || $data[$jsonField] === null) {
                $data[$jsonField] = null;
            }
        }
    }
    if (isset($data['pump']) && is_array($data['pump']) && isset($data['pump']['id'])) {
        $data['pump_id'] = $data['pump']['id'];
    }
    if (isset($data['uploader']) && is_array($data['uploader']) && isset($data['uploader']['id'])) {
        $data['uploader_id'] = $data['uploader']['id'];
    }
    if (isset($data['xdripjs']) && is_array($data['xdripjs']) && isset($data['xdripjs']['id'])) {
        $data['xdripjs_id'] = $data['xdripjs']['id'];
    }

    $fixedFields = [
        '_id', 'device', 'created_at', 'openaps', 'loop', 'uploaderBattery',
        'isCharging', 'configuration', 'pump_id', 'pump',
        'uploader_id', 'uploader', 'xdripjs_id', 'xdripjs'
    ];

    $extra = collect($data)->except($fixedFields)->toArray();
    $main = collect($data)->only($fixedFields)->toArray();


    $main['extra_data'] = $extra;
    Log::info('DeviceStatusController@store called with data: ' . json_encode($main));

    DeviceStatus::create($main);

    return response()->json([
        'message' => 'DeviceStatus saved'
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
        Log::info('DeviceStatusController@destroySpec called with spec: ' . $spec);
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
