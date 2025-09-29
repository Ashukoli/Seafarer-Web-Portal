<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateHiddenCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_hidden_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('candidate_id')->index();
            $table->unsignedBigInteger('company_id')->index();
            $table->timestamps();

            // unique constraint to avoid duplicates
            $table->unique(['candidate_id', 'company_id']);

            // optional foreign keys (uncomment if you want DB-level FK enforcement)
            // $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_hidden_companies');
    }
}
