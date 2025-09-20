<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyBannersTable extends Migration
{
    public function up()
    {
        Schema::create('company_banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->string('image')->nullable();
            $table->string('section')->nullable();
            $table->integer('order')->nullable();
            $table->string('status')->default('enabled');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('company_details')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_banners');
    }
}
