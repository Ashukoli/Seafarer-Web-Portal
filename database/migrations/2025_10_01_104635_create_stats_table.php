<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->morphs('statable');                       // statable_id + statable_type
            $table->string('event', 50)->index();            // 'view', 'apply', etc.
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('ip', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->json('meta')->nullable();                // extra info (referrer, source)
            $table->timestamps();

            $table->index(['statable_type','event']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('stats');
    }
};
