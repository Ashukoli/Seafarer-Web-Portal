<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

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
}
