<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipType extends Model
{
    use SoftDeletes;

    protected $table = 'ship_types';

    protected $fillable = [
        'ship_name',
        'sort',
    ];

    protected $casts = [
        'sort' => 'integer',
    ];
}
