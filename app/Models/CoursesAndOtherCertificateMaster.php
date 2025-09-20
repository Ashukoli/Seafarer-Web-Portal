<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoursesAndOtherCertificateMaster extends Model
{
    use SoftDeletes;

    // Explicit table name (snake_case plural not used here)
    protected $table = 'courses_and_other_certificate_master';

    // Mass assignable
    protected $fillable = [
        'name',
        'sort',
    ];

    // If you don't use guarded, you can set it empty:
    // protected $guarded = [];

    // If you want to cast dates
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Default ordering scope (optional)
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort')->orderBy('name');
    }
}
