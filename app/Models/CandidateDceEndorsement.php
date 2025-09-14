<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateDceEndorsement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'candidate_dce_endorsements';

    protected $fillable = [
        'user_id',
        'dce_id',           // FK -> dce_endorsements (master)
        'validity_date',
    ];

    protected $casts = [
        'validity_date' => 'date',
    ];

    /***** Relationships *****/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dce()
    {
        return $this->belongsTo(DceEndorsement::class, 'dce_id');
    }
}
