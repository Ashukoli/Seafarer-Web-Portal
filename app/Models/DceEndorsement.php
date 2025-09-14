<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DceEndorsement extends Model
{
    use HasFactory;

    protected $fillable = ['dce_name', 'sort'];
}
