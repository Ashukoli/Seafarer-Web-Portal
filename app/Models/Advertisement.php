<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $table = 'company_advertisements';

    protected $fillable = [
        'company_id',
        'description',
        'posted_date',
        'subject',
        'advertisement_type',
        'banner_image',
    ];

    public function company()
    {
        return $this->belongsTo(CompanyDetail::class, 'company_id');
    }
}
