<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySubadmin extends Model
{
    protected $table = 'company_subadmins';

    protected $fillable = [
        'company_id',
        'user_id',
    ];

    public function company()
    {
        return $this->belongsTo(CompanyDetail::class, 'company_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
