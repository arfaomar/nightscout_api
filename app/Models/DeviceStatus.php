<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceStatus extends Model
{
    use HasFactory;

    protected $table = 'device_statuses';

    protected $primaryKey = '_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
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
        'xdripjs',
        'extra_data',
    ];

    protected $casts = [
        'pump' => 'array',
        'uploader' => 'array',
        'xdripjs' => 'array',
        'configuration' => 'array',
        'isCharging' => 'boolean',
        'extra_data' => 'array',
    ];
}
