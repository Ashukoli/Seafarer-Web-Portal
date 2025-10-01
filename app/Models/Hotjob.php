<?php
// app/Models/Hotjob.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotjob extends Model
{
    protected $fillable = [
        'company_id', 'rank_id', 'ship_id', 'joiningdate', 'nationality', 'experience',
        'description', 'expiry_date', 'status', 'withsms',
        'posted_by_name', 'posted_by_email', 'posted_by_country_code','posted_by_mobile',
    ];

    public function company()
    {
        return $this->belongsTo(CompanyDetail::class, 'company_id');
    }
    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }
    public function ship()
    {
        return $this->belongsTo(ShipType::class, 'ship_id');
    }

    public function stats()
    {
        return $this->morphMany(Stat::class, 'statable');
    }

}
