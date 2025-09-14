<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumesTable extends Migration
{
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Relate to candidate_profiles (preferred) and user (optional)
            //$table->unsignedBigInteger('profile_id')->nullable()->index()->comment('candidate_profiles.id');
            $table->unsignedBigInteger('user_id')->nullable()->index()->comment('users.id');

            // Resume details (from your list)
            $table->string('present_rank')->nullable();
            $table->string('present_rank_exp')->nullable()->comment('e.g. 1 year, 6 months or a code');
            $table->string('post_applied_for')->nullable();
            $table->date('date_of_availability')->nullable();
            $table->string('indos_number')->nullable();
            $table->string('passport_nationality')->nullable();
            $table->string('passport_number')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->boolean('usa_visa')->nullable()->comment('0 = no, 1 = yes');

            $table->string('cdc_nationality')->nullable();
            $table->string('cdc_no')->nullable();
            $table->date('cdc_expiry')->nullable();

            $table->string('presea_training_type')->nullable();
            $table->date('presea_training_issue_date')->nullable();

            $table->boolean('coc_held')->default(false);
            $table->string('coc_type')->nullable();
            $table->string('coc_no')->nullable();
            $table->date('coc_date_of_expiry')->nullable();

            $table->text('additional_information')->nullable();

            // Soft deletes & timestamps
            $table->softDeletes();
            $table->timestamps();

            // FKs (optional)
            //$table->foreign('profile_id')->references('id')->on('candidate_profiles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('resumes', function (Blueprint $table) {
            if (Schema::hasColumn('resumes', 'profile_id')) {
                $table->dropForeign(['profile_id']);
            }
            if (Schema::hasColumn('resumes', 'user_id')) {
                $table->dropForeign(['user_id']);
            }
        });
        Schema::dropIfExists('resumes');
    }
}
