<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;

    protected $fillable = ['country_id', 'state_name', 'sort', 'status'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
