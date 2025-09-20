<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'email',
        'contact_no',
        'website',
        'rpsl_number',
        'rpsl_expiry',
        'area',
        'address',
        'company_type',
        'account_type',
        'tie_up_company',
        'listed_in_banner',
        'directors',
    ];

    public function banners()
    {
        return $this->hasMany(Banner::class);
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
