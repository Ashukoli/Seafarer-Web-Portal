<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySubadminLoginLog extends Model
{
    protected $fillable = [
        'user_id', 'company_id', 'login_at', 'logout_at',
        'ip_address', 'ip_location', 'session_id', 'user_agent', 'duration_seconds'
    ];

    protected $casts = [
        'ip_location' => 'array',
        'login_at' => 'datetime',
        'logout_at' => 'datetime',
    ];
}
