<?php
// filepath: database/migrations/2025_09_17_003326_create_company_subadmins_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanySubadminsTable extends Migration
{
    public function up()
    {
        Schema::create('company_subadmins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('company_details')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['company_id', 'user_id']); // Prevent duplicate subadmins for same company
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_subadmins');
    }
}
