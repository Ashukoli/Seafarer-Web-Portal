<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'candidate_profiles';

    protected $fillable = [
        'user_id',
        'seafarer_id',
        'first_name',
        'middle_name',
        'last_name',
        'marital_status',
        'dob',
        'mobile_cc',
        'mobile_number',
        'whatsapp_cc',
        'whatsapp_number',
        'address',
        'profile_pic',
        'gender',
        'nationality',
        'state_id',
        'city_id',
        'profile_completion',
        'completion_steps',
    ];

    protected $casts = [
        'dob' => 'date',
        'completion_steps' => 'array',
        'profile_completion' => 'integer',
    ];

    /***** Relationships *****/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /***** Helper accessors *****/

    public function getFullNameAttribute(): string
    {
        return trim( ($this->first_name ?? '') . ' ' . ($this->middle_name ? $this->middle_name . ' ' : '') . ($this->last_name ?? '') );
    }
}
