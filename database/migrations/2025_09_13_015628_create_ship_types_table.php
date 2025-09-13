<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipTypesTable extends Migration
{
    public function up()
    {
        Schema::create('ship_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ship_name', 191)->index();
            $table->integer('sort')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ship_types');
    }
}
