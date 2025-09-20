<?php
// filepath: database/migrations/2025_09_17_000002_create_company_details_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('company_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->unique(); // Superadmin user_id

            // Package references
            $table->unsignedBigInteger('resume_view_package_id')->nullable();
            $table->unsignedBigInteger('resume_download_package_id')->nullable();
            $table->unsignedBigInteger('hotjobs_package_id')->nullable();

            $table->date('package_expiry')->nullable();

            // Company details
            $table->string('company_name')->unique();
            $table->string('company_email');
            $table->string('company_contact_country_code', 8)->nullable();
            $table->string('company_contact_no', 200)->nullable();
            $table->string('website')->nullable();
            $table->string('rpsl_number')->nullable();
            $table->date('rpsl_expiry')->nullable();
            $table->string('area')->nullable();
            $table->text('address')->nullable();
            $table->enum('company_type', ['shipowner', 'crewing'])->nullable()->comment('1: Shipowner/Operator, 2: Crewing Company');
            $table->enum('account_type', ['advertisement', 'database'])->nullable();
            $table->boolean('tie_up_company')->default(false);
            $table->boolean('listed_in_banner')->default(false);
            $table->string('company_logo')->nullable();
            $table->text('directors')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('resume_view_package_id')->references('id')->on('packages')->onDelete('set null');
            $table->foreign('resume_download_package_id')->references('id')->on('packages')->onDelete('set null');
            $table->foreign('hotjobs_package_id')->references('id')->on('packages')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_details');
    }
}
