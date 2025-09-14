<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeaServiceDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sea_service_details';

    protected $fillable = [
        'user_id',
        'rank_id',          // FK -> ranks.id
        'ship_type_id',     // FK -> shiptypes.id
        'sign_on',
        'sign_off',
        'company_name',
        'ship_name',
        'grt',
        'bhp',
        'notes',
    ];

    protected $casts = [
        'sign_on' => 'date',
        'sign_off' => 'date',
    ];

    /***** Relationships *****/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }

    public function shipType()
    {
        return $this->belongsTo(ShipType::class, 'ship_type_id');
    }

    /**
     * Compute duration in days (helper).
     */
    public function getDurationDaysAttribute()
    {
        if (! $this->sign_on || ! $this->sign_off) {
            return null;
        }

        return \Carbon\Carbon::parse($this->sign_on)->diffInDays(\Carbon\Carbon::parse($this->sign_off));
    }
}
