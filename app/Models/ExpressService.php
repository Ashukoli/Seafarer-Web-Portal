<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpressService extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_title',
        'description',
        'amount',
        'image',
        'status',
    ];
}