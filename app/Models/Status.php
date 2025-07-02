<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';

    protected $primaryKey = '_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        '_id',
        'apiEnabled',
        'carePortalEnabled',
        'head',
        'name',
        'version',
        'settings',
        'extended_settings',
        'extra_data',
    ];

    protected $casts = [
        'apiEnabled' => 'boolean',
        'carePortalEnabled' => 'boolean',
        'settings' => 'array',
        'extended_settings' => 'array',
        'extra_data' => 'array',
    ];
}
