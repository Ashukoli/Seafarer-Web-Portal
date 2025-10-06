<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateResume extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'candidate_resumes';

    protected $fillable = [
        'user_id',
        'present_rank',            // FK -> ranks.id
        'present_rank_exp',
        'post_applied_for',        // FK -> ranks.id (post)
        'date_of_availability',
        'indos_number',
        'passport_nationality',
        'passport_number',
        'passport_expiry',
        'usa_visa',
        'cdc_nationality',
        'cdc_no',
        'cdc_expiry',
        'presea_training_type',
        'presea_training_issue_date',
        'coc_held',
        'coc_no',
        'coc_type',
        'coc_date_of_expiry',
        'additional_information',
    ];

    protected $casts = [
        'date_of_availability' => 'date',
        'passport_expiry' => 'date',
        'cdc_expiry' => 'date',
        'presea_training_issue_date' => 'date',
        'coc_date_of_expiry' => 'date',
    ];

    /***** Relationships *****/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function presentRank()
    {
        return $this->belongsTo(Rank::class, 'present_rank');
    }

    public function postAppliedFor()
    {
        return $this->belongsTo(Rank::class, 'post_applied_for');
    }

    public function rank()
    {
        // Alias for presentRank for compatibility with search code
        return $this->presentRank();
    }

    public function shipType()
    {
        // If you have a single ship_type column (FK to ship_types.id)
        return $this->belongsTo(ShipType::class, 'ship_type');
    }

    public function ship_types()
    {
        // If you have a pivot table for multiple ship types (optional)
        return $this->belongsToMany(ShipType::class, 'candidate_ship_types', 'candidate_resume_id', 'ship_type_id');
    }
}
