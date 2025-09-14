<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateCourseCertificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'candidate_course_certificates';

    protected $fillable = [
        'user_id',
        'course_id', // FK -> course_certificates (master)
        // Optional per-candidate fields can be added later like issue_date/expiry_number etc.
    ];

    /***** Relationships *****/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Course master. Adjust model name if your master is named differently.
     */
    public function course()
    {
        return $this->belongsTo(CourseCertificate::class, 'course_id');
    }
}
