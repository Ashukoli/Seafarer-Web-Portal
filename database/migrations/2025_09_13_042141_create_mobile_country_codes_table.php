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
        Schema::create('mobile_country_codes', function (Blueprint $table) {
            $table->id();
            $table->string('country_name');
            $table->string('country_code', 5); // ISO Alpha-2 or Alpha-3 code
            $table->string('dial_code', 10);   // e.g. +91, +1
            $table->boolean('status')->default(1); // Active/Inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobile_country_codes');
    }
};
