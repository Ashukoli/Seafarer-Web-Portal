<?php
// app/Models/CompanyFollowUp.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyFollowUp extends Model
{
    protected $fillable = [
        'company_id',
        'executive',
        'follow_up_date',
        'message',
        'next_follow_up_date',
        'followup_taken',
    ];

    public function company()
    {
        return $this->belongsTo(CompanyDetail::class, 'company_id');
    }
}
