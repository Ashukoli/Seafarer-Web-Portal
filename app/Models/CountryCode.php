<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryCode extends Model
{
    protected $table = 'mobile_country_codes';

    protected $fillable = [
        'country_name',
        'country_code',
        'dial_code',
        'status',
    ];

    public $timestamps = true;
}
