<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanySubadminLoginLogsTable extends Migration
{
    public function up()
    {
        Schema::create('company_subadmin_login_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            // The user (company subadmin) who logged in
            $table->unsignedBigInteger('user_id')->index()->comment('references users.id (company subadmin)');

            // Optional: link to company id (if you keep companies separate)
            $table->unsignedBigInteger('company_id')->nullable()->index()->comment('optional link to companies table');

            // Login and logout timestamps (with timezone)
            $table->timestampTz('login_at')->useCurrent();
            $table->timestampTz('logout_at')->nullable();

            // IP + geo location info
            $table->ipAddress('ip_address')->nullable();
            $table->json('ip_location')->nullable()->comment('JSON: {country, region, city, lat, lon, timezone, provider, etc.}');

            // Helpful fields for session matching and audit
            $table->string('session_id', 255)->nullable()->index();
            $table->string('user_agent', 1024)->nullable();

            // Computed duration in seconds (filled on logout)
            $table->integer('duration_seconds')->nullable();

            // Timestamps
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // If you have a companies table:
            // $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('company_subadmin_login_logs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            // if you added company FK: $table->dropForeign(['company_id']);
        });
        Schema::dropIfExists('company_subadmin_login_logs');
    }
}
