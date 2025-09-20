<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyAdvertisementsTable extends Migration
{
    public function up()
    {
        Schema::create('company_advertisements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->longText('description'); // Changed from text to longText
            $table->date('posted_date');
            $table->string('subject');
            $table->enum('advertisement_type', ['fixed', 'customized']);
            $table->string('banner_image')->nullable();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('company_details')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_advertisements');
    }
}
