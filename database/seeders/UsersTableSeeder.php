<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // 1) Admin Super Admin (top-level)
        $superAdminId = DB::table('users')->insertGetId([
            'user_type' => 'admin',
            'role' => 'super_admin',
            'username' => 'SuperAdmin', // case-sensitive username
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@seafarerjobs.test',
            'password' => Hash::make('password'), // test password = "password"
            'email_verified_at' => $now,
            'status' => 'active',
            'remember_token' => Str::random(60),
            'failed_login_attempts' => 0,
            'created_by' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 2) Admin Subadmin and Executive (created_by -> SuperAdmin)
        $adminSubId = DB::table('users')->insertGetId([
            'user_type' => 'admin',
            'role' => 'subadmin',
            'username' => 'AdminSub',
            'first_name' => 'Admin',
            'last_name' => 'Sub',
            'email' => null, // per requirement: admin-subadmin email not compulsory
            'password' => Hash::make('password'),
            'email_verified_at' => null,
            'status' => 'active',
            'remember_token' => Str::random(60),
            'failed_login_attempts' => 0,
            'created_by' => $superAdminId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $adminExecId = DB::table('users')->insertGetId([
            'user_type' => 'admin',
            'role' => 'executive',
            'username' => 'AdminExec',
            'first_name' => 'Admin',
            'last_name' => 'Executive',
            'email' => null,
            'password' => Hash::make('password'),
            'email_verified_at' => null,
            'status' => 'active',
            'remember_token' => Str::random(60),
            'failed_login_attempts' => 0,
            'created_by' => $superAdminId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 3) Company Super Admin
        $companySuperId = DB::table('users')->insertGetId([
            'user_type' => 'company',
            'role' => 'super_admin',
            'username' => 'CompanySuper',
            'first_name' => 'Company',
            'last_name' => 'Owner',
            'email' => 'company.super@seafarer.test',
            'password' => Hash::make('password'),
            'email_verified_at' => $now,
            'status' => 'active',
            'remember_token' => Str::random(60),
            'failed_login_attempts' => 0,
            'created_by' => $superAdminId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 4) Company Subadmin (email NOT mandatory)
        $companySubId = DB::table('users')->insertGetId([
            'user_type' => 'company',
            'role' => 'subadmin',
            'username' => 'CompanySub',
            'first_name' => 'Company',
            'last_name' => 'Sub',
            'email' => null, // per requirement: company subadmin email not mandatory
            'password' => Hash::make('password'),
            'email_verified_at' => null,
            'status' => 'pending',
            'remember_token' => Str::random(60),
            'failed_login_attempts' => 0,
            'created_by' => $companySuperId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 5) Candidates — multiple with varied statuses (login uses email/password)
        $candidate1 = DB::table('users')->insertGetId([
            'user_type' => 'candidate',
            'role' => 'candidate',
            'username' => null,
            'first_name' => 'Alice',
            'last_name' => 'Candidate',
            'email' => 'candidate.active1@example.test',
            'password' => Hash::make('password'),
            'email_verified_at' => $now,
            'status' => 'active',
            'remember_token' => Str::random(60),
            'failed_login_attempts' => 0,
            'created_by' => $superAdminId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $candidate2 = DB::table('users')->insertGetId([
            'user_type' => 'candidate',
            'role' => 'candidate',
            'username' => null,
            'first_name' => 'Bob',
            'last_name' => 'Pending',
            'email' => 'candidate.pending1@example.test',
            'password' => Hash::make('password'),
            'email_verified_at' => null,
            'status' => 'pending',
            'remember_token' => Str::random(60),
            'failed_login_attempts' => 0,
            'created_by' => $superAdminId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $candidate3 = DB::table('users')->insertGetId([
            'user_type' => 'candidate',
            'role' => 'candidate',
            'username' => null,
            'first_name' => 'Charlie',
            'last_name' => 'Incomplete',
            'email' => 'candidate.incomplete1@example.test',
            'password' => Hash::make('password'),
            'email_verified_at' => null,
            'status' => 'incomplete',
            'remember_token' => Str::random(60),
            'failed_login_attempts' => 0,
            'created_by' => $superAdminId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 6) Extra: a second SuperAdmin with different-case username to test case-sensitivity
        DB::table('users')->insert([
            'user_type' => 'admin',
            'role' => 'super_admin',
            'username' => 'superadmin', // same letters but different case
            'first_name' => 'Super',
            'last_name' => 'AdminLower',
            'email' => 'superadmin.lowercase@seafarer.test',
            'password' => Hash::make('password'),
            'email_verified_at' => $now,
            'status' => 'active',
            'remember_token' => Str::random(60),
            'failed_login_attempts' => 0,
            'created_by' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->command->info('UsersTableSeeder: seeded admin, company and candidate users (with first_name & last_name).');
    }
}
