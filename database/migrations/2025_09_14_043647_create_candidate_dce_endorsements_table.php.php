<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateDceEndorsementsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidate_dce_endorsements', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Candidate (user)
            $table->unsignedBigInteger('user_id')->index();

            // Master DCE reference (must match master table name and PK type)
            $table->unsignedBigInteger('dce_id')->index();

            // Candidate-specific fields
            $table->date('validity_date')->nullable(); // or 'issued_at' if you prefer
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Foreign keys
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            // <-- IMPORTANT: refer to the actual master table name (dce_endorsements)
            $table->foreign('dce_id')
                  ->references('id')->on('dce_endorsements')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('candidate_dce_endorsements');
        Schema::enableForeignKeyConstraints();
    }
}
