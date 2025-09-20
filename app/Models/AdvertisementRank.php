<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementRank extends Model
{
    protected $table = 'advertisement_ranks';

    protected $fillable = [
        'advertisement_id',
        'shiptype_id',
        'rank_id',
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id');
    }
}
