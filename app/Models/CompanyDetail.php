<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    protected $table = 'company_details';

    // Add all fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'resume_view_package_id',
        'resume_download_package_id',
        'hotjobs_package_id',
        'package_expiry',
        'company_name',
        'company_email',
        'company_contact_country_code',
        'company_contact_no',
        'website',
        'rpsl_number',
        'rpsl_expiry',
        'area',
        'address',
        'company_type',
        'account_type',
        'tie_up_company',
        'listed_in_banner',
        'company_logo',
        'directors',
    ];

    // Relationships (example)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resumeViewPackage()
    {
        return $this->belongsTo(Package::class, 'resume_view_package_id');
    }

    public function resumeDownloadPackage()
    {
        return $this->belongsTo(Package::class, 'resume_download_package_id');
    }

    public function hotjobsPackage()
    {
        return $this->belongsTo(Package::class, 'hotjobs_package_id');
    }

    public function superadmin()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function subadmins()
    {
        return $this->hasMany(\App\Models\CompanySubadmin::class, 'company_id');
    }
}
