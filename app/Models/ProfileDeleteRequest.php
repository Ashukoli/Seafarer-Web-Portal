<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileDeleteRequest extends Model
{
    protected $table = 'profile_delete_requests';

    protected $fillable = [
        'candidate_id', 'reason', 'other_reason', 'status', 'processed_by', 'processed_at'
    ];

    public function candidate()
    {
        return $this->belongsTo(\App\Models\User::class, 'candidate_id');
    }

    public function processor()
    {
        return $this->belongsTo(\App\Models\User::class, 'processed_by');
    }
}
