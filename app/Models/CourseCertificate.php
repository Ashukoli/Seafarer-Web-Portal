<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCertificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'courses_and_other_certificate_master';

    protected $fillable = [
        'name',
        'sort',
    ];

    // default ordering helper scope
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort')->orderBy('name');
    }
}
