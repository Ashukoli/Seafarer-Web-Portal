<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumesTable extends Migration
{
    public function up()
    {
        Schema::create('candidate_resumes', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('user_id')->nullable()->index()->comment('users.id');

        $table->string('present_rank')->nullable();
        $table->string('present_rank_exp')->nullable();
        $table->string('post_applied_for')->nullable();
        $table->date('date_of_availability')->nullable();
        $table->string('indos_number')->nullable();
        $table->string('passport_nationality')->nullable();
        $table->string('passport_number')->nullable();
        $table->date('passport_expiry')->nullable();
        $table->boolean('usa_visa')->nullable();

        $table->string('cdc_nationality')->nullable();
        $table->string('cdc_no')->nullable();
        $table->date('cdc_expiry')->nullable();

        $table->string('presea_training_type')->nullable();
        $table->date('presea_training_issue_date')->nullable();

        $table->boolean('coc_held')->nullable()->default(null);
        $table->string('coc_type')->nullable();
        $table->string('coc_no')->nullable();
        $table->date('coc_date_of_expiry')->nullable();

        $table->text('additional_information')->nullable();

        $table->softDeletes();
        $table->timestamps();

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
