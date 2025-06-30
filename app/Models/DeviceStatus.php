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
        'pump_id',
        'pump',
        'uploader_id',
        'uploader',
        'xdripjs_id',
        'xdripjs',
    ];

    protected $casts = [
        'pump' => 'array',
        'uploader' => 'array',
        'xdripjs' => 'array',
        'configuration' => 'array',
        'isCharging' => 'boolean',
    ];


    public function pump()
    {
        return $this->belongsTo(Pump::class, 'pump_id');
    }
    public function uploader()
    {
        return $this->belongsTo(Uploader::class, 'uploader_id');
    }
    public function xdripjs()
    {
        return $this->belongsTo(Xdripjs::class, 'xdripjs_id');
    }
}
