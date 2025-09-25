<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

// Eloquent relation return types
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Related models (ensure these classes exist in this namespace)
use App\Models\CandidateProfile;
use App\Models\CandidateResume;
use App\Models\SeaServiceDetail;
use App\Models\CandidateDceEndorsement;
use App\Models\CandidateCourseCertificate;
use App\Models\Rank;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $user_type
 * @property string|null $role
 * @property-read string $name
 * @property string|null $designation
 * @property string $country_code
 * @property string $mobile
 * @property string $password
 * @property int|null $company_id
 *
 * Relations (for IDEs / Intelephense)
 * @property-read \App\Models\CandidateProfile|null $profile
 * @property-read \App\Models\CandidateResume|null $resume
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SeaServiceDetail[] $seaServiceDetails
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CandidateDceEndorsement[] $dceEndorsements
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CandidateCourseCertificate[] $courseCertificates
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'user_type',
        'role',
        'username',
        'first_name',
        'last_name',
        'designation',
        'country_code',
        'mobile',
        'email',
        'password',
        'status',
        'email_verified_at',
        'failed_login_attempts',
        'locked_until',
        'last_login_at',
        'last_login_ip',
        'created_by',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at'    => 'datetime',
        'last_login_at'        => 'datetime',
        'locked_until'         => 'datetime',
        'failed_login_attempts'=> 'integer',
    ];

    protected $attributes = [
        'status'               => 'pending',
        'failed_login_attempts'=> 0,
    ];

    // -------------------------------------------------
    // Helpers by type
    // -------------------------------------------------
    public function isAdmin(): bool
    {
        return $this->user_type === 'admin';
    }

    public function isCompany(): bool
    {
        return $this->user_type === 'company';
    }

    public function isCandidate(): bool
    {
        return $this->user_type === 'candidate';
    }

    // -------------------------------------------------
    // Account lockout helper
    // -------------------------------------------------
    public function isLocked(): bool
    {
        return $this->locked_until instanceof Carbon && $this->locked_until->isFuture();
    }

    // -------------------------------------------------
    // Candidate related relationships
    // -------------------------------------------------

    /**
     * Candidate profile (candidate_profiles.user_id)
     *
     * @return HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne(CandidateProfile::class, 'user_id', 'id');
    }

    /**
     * Candidate resume (candidate_resumes.user_id)
     *
     * @return HasOne
     */
    public function resume(): HasOne
    {
        return $this->hasOne(CandidateResume::class, 'user_id', 'id');
    }

    /**
     * Sea service records (sea_service_details.user_id)
     *
     * @return HasMany
     */
    public function seaServiceDetails(): HasMany
    {
        return $this->hasMany(SeaServiceDetail::class, 'user_id', 'id');
    }

    /**
     * DCE/GMDSS endorsements (candidate_dce_endorsements.user_id)
     *
     * @return HasMany
     */
    public function dceEndorsements(): HasMany
    {
        return $this->hasMany(CandidateDceEndorsement::class, 'user_id', 'id');
    }

    /**
     * Course certificates (candidate_course_certificates.user_id)
     *
     * @return HasMany
     */
    public function courseCertificates(): HasMany
    {
        return $this->hasMany(CandidateCourseCertificate::class, 'user_id', 'id');
    }

    /**
     * Convenience relation: present rank (if stored as FK on resume or user)
     *
     * @return BelongsTo
     */
    public function presentRank(): BelongsTo
    {
        // If present_rank is stored on resume, you might want to access through resume relation instead.
        return $this->belongsTo(Rank::class, 'present_rank', 'id');
    }

    /**
     * Return full name attribute
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        $first = $this->first_name ?? '';
        $last = $this->last_name ?? '';
        return trim($first . ' ' . $last) ?: ($this->username ?? $this->email ?? 'User ' . $this->id);
    }
}
