<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateHiddenCompany extends Model
{
    protected $table = 'candidate_hidden_companies';

    protected $fillable = [
        'candidate_id',
        'company_id',
    ];

    public function companyDetail()
    {
        return $this->belongsTo(CompanyDetail::class, 'company_id');
    }

    public function candidate()
    {
        return $this->belongsTo(\App\Models\User::class, 'candidate_id');
    }
}
