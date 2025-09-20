<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // Primary
            $table->bigIncrements('id');

            // User category and sub-role
            $table->enum('user_type', ['admin', 'company', 'candidate'])->index()
                  ->comment('admin | company | candidate');

            // Role/sub-role — flexible string so you can add roles later without altering migration
            // Examples: super_admin, subadmin, executive, candidate
            $table->string('role', 50)->nullable()->comment('sub-role: super_admin, subadmin, executive, candidate');

            // Username: used by Admin and Company logins. Must be case-sensitive.
            // We enforce case-sensitivity at DB level by using a binary collation for this column.
            $table->string('username', 100)
                  ->nullable()
                  ->collation('utf8mb4_bin')
                  ->unique()
                  ->comment('Case-sensitive username for admin/company. Nullable for candidates.');

            // First & Last name (nullable — useful for display/profile)
            $table->string('first_name', 100)->nullable()->comment('given name / first name');
            $table->string('last_name', 100)->nullable()->comment('family name / last name');

            // Email: used by Candidates to login (required at application level).
            // Nullable for Admin subadmins/executives and Company subadmins per your requirements.
            $table->string('email', 191)
                  ->nullable()
                  ->unique()
                  ->comment('Candidate: required. Admin/company subadmins: optional.');
            $table->string('country_code', 8)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('designation', 255)->nullable();
            // Password (hashed). Required for all account types that login with password.
            $table->string('password', 255)->comment('hashed password');

            // Email verification
            $table->timestamp('email_verified_at')->nullable();

            // Status: shared superset for candidates and companies.
            // Candidate statuses: pending/active/inactive/suspended/incomplete
            // Company statuses: pending/active/inactive/suspended
            $table->enum('status', ['pending', 'active', 'inactive', 'suspended', 'incomplete'])
                  ->default('pending')
                  ->index()
                  ->comment('account status');

            // Authentication helpers / audit
            $table->rememberToken()->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->ipAddress('last_login_ip')->nullable();

            // Generic security fields (helpful for brute-force or lockouts)
            $table->unsignedSmallInteger('failed_login_attempts')->default(0);
            $table->timestamp('locked_until')->nullable();

            // Who created this user (nullable, in case a system seed or external import)
            $table->unsignedBigInteger('created_by')->nullable()->comment('users.id of creator');

            // Soft deletes and timestamps
            $table->softDeletes(); // deleted_at
            $table->timestamps(); // created_at, updated_at

            // Foreign key for created_by (self reference)
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        // Drop FK first then table
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
        });
        Schema::dropIfExists('users');
    }
}
