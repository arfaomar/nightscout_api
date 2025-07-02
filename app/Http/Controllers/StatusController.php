<?php

namespace App\Http\Controllers;

use App\Models\Status;

class StatusController extends Controller
{
    // GET /status
    public function index()
    {
        $status = Status::first();

        if (! $status) {
            return response()->json([
                'status' => 'ok',
                'name' => 'nightscout',
                'version' => '15.0.2',
                'serverTime' => now()->toIso8601String(),
                'serverTimeEpoch' => now()->getTimestampMs(),
                'apiEnabled' => true,
                'careportalEnabled' => true,
                'boluscalcEnabled' => false,
                'settings' => new \stdClass,
                'extendedSettings' => new \stdClass,
                'authorized' => null,
                'runtimeState' => 'loaded',
            ]);
        }

        return response()->json([
            'status' => 'ok',
            'name' => $status->name ?? 'nightscout',
            'version' => $status->version ?? '15.0.2',
            'serverTime' => now()->toIso8601String(),
            'serverTimeEpoch' => now()->getTimestampMs(),
            'apiEnabled' => $status->apiEnabled ?? true,
            'careportalEnabled' => $status->carePortalEnabled ?? true,
            'boluscalcEnabled' => $status->boluscalcEnabled ?? false,
            'settings' => $status->settings ?? new \stdClass,
            'extendedSettings' => $status->extended_settings ?? new \stdClass,
            'authorized' => $status->authorized ?? null,
            'runtimeState' => $status->runtimeState ?? 'loaded',
        ]);
    }
}
