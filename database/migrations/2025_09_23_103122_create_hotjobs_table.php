<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hotjobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('rank_id');
            $table->unsignedBigInteger('ship_id');
            $table->date('joiningdate')->nullable();
            $table->string('nationality')->nullable();
            $table->string('experience')->nullable();
            $table->text('description')->nullable();
            $table->date('expiry_date')->nullable();
            $table->enum('status', ['pending', 'active', 'expired'])->default('pending');
            $table->enum('withsms', ['yes', 'no'])->default('no');
            $table->string('posted_by_name')->nullable();
            $table->string('posted_by_email')->nullable();
            $table->string('posted_by_country_code')->nullable();
            $table->string('posted_by_mobile')->nullable();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('company_details')->onDelete('cascade');
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
            $table->foreign('ship_id')->references('id')->on('ship_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotjobs');
    }
};
