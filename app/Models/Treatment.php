<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $table = 'treatments';

    protected $primaryKey = '_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
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
        'enteredBy',
        'extra_data',
    ];

    protected $casts = [
        'extra_data' => 'array',
    ];
}
