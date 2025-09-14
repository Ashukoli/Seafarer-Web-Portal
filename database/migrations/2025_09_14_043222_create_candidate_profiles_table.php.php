<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidate_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Link to users table (account owner)
            $table->unsignedBigInteger('user_id')->nullable()->index();

            // Legacy mapping from old DB (if required)
            $table->string('seafarer_id')->nullable()->index();

            // Personal fields
            $table->string('first_name', 100)->nullable();
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            $table->date('dob')->nullable();
            $table->string('mobile_cc', 6)->nullable();
            $table->string('mobile_number', 30)->nullable();
            $table->string('whatsapp_cc', 6)->nullable();
            $table->string('whatsapp_number', 30)->nullable();
            $table->text('address')->nullable();
            $table->string('profile_pic')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('nationality', 100)->nullable();

            // Location
            $table->unsignedBigInteger('state_id')->nullable()->index();
            $table->unsignedBigInteger('city_id')->nullable()->index();

            // Profile completion tracking
            $table->unsignedTinyInteger('profile_completion')->default(0);
            $table->json('completion_steps')->nullable();

            // Soft delete + timestamps
            $table->softDeletes();
            $table->timestamps();

            // Foreign key: user
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Foreign key to states table (if it exists)
        if (Schema::hasTable('states')) {
            Schema::table('candidate_profiles', function (Blueprint $table) {
                $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            });
        }

        // Foreign key to cities table (if it exists)
        if (Schema::hasTable('cities')) {
            Schema::table('candidate_profiles', function (Blueprint $table) {
                $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            });
        }
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('candidate_profiles');
        Schema::enableForeignKeyConstraints();
    }
};
