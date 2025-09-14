<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateCourseCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidate_course_certificates', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Candidate (user)
            $table->unsignedBigInteger('user_id')->index();
            // Master course reference
            $table->unsignedBigInteger('course_id')->index();
            $table->timestamps();
            $table->softDeletes();

            // Foreign keys
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('course_id')
                  ->references('id')->on('courses_and_other_certificate_master')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('candidate_course_certificates');
        Schema::enableForeignKeyConstraints();
    }
}
