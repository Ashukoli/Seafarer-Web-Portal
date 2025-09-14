<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeaServiceDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('sea_service_details', function (Blueprint $table) {
            $table->bigIncrements('id');

            //$table->unsignedBigInteger('profile_id')->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();

            // Sea service-specific fields
            $table->string('rank')->nullable();
            $table->string('ship_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('ship_type')->nullable();
            $table->string('engine_type')->nullable();
            $table->string('grt')->nullable();
            $table->string('bhp')->nullable();

            $table->date('sign_on_date')->nullable();
            $table->date('sign_off_date')->nullable();

            // computed duration or raw days stored (optional)
            //$table->integer('duration_days')->nullable()->comment('optional pre-computed duration in days');

            //$table->text('remarks')->nullable();

            $table->timestamps();
            $table->softDeletes();

            //$table->foreign('profile_id')->references('id')->on('candidate_profiles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('sea_service_details', function (Blueprint $table) {

            if (Schema::hasColumn('sea_service_details', 'user_id')) {
                $table->dropForeign(['user_id']);
            }
        });

        Schema::dropIfExists('sea_service_details');
    }
}
