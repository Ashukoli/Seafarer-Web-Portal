<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_company_follow_ups_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('company_follow_ups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('executive');
            $table->date('follow_up_date');
            $table->string('message');
            $table->date('next_follow_up_date')->nullable();
            $table->boolean('followup_taken')->default(false);
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('company_details')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_follow_ups');
    }
};
