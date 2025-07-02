<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';
    protected $primaryKey = '_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        '_id',
        'eventType',
        'duration',
        'created_at',
        'notes',
        'enteredBy',
        'extra_data',
    ];

    protected $casts = [
        'extra_data' => 'array',
    ];
}
