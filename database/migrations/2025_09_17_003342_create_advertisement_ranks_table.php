<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementRanksTable extends Migration
{
    public function up()
    {
        Schema::create('advertisement_ranks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('advertisement_id');
            $table->unsignedBigInteger('shiptype_id');
            $table->unsignedBigInteger('rank_id');
            $table->timestamps();

            $table->foreign('advertisement_id')->references('id')->on('company_advertisements')->onDelete('cascade');
            $table->foreign('shiptype_id')->references('id')->on('ship_types')->onDelete('cascade');
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('advertisement_ranks');
    }
}
