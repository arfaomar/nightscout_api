<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $table = 'entries';

    protected $primaryKey = '_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
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
        'extra_data',
    ];

    protected $casts = [
        'extra_data' => 'array',
    ];
}
