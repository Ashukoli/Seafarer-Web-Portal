<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country_name', 191)->unique();
            $table->string('country_code', 10)->nullable(); // e.g., IN, US
            $table->integer('sort')->default(0)->index();
            $table->boolean('status')->default(1); // 1=active, 0=inactive
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
