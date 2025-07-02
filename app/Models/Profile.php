<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    protected $primaryKey = '_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        '_id',
        'defaultProfile',
        'date',
        'created_at',
        'startDate',
        'store',
        'extra_data',
    ];

    protected $casts = [
        'store' => 'array',
        'extra_data' => 'array',
        'date' => 'integer',
        'created_at' => 'datetime',
        'startDate' => 'datetime',
    ];
}
