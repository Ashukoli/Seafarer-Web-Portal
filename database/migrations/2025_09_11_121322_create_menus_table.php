<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Menu title
            $table->string('title', 150);

            // Identifier (for internal usage)
            $table->string('slug', 150)->nullable()->unique();

            // Menu type/scope: admin | company | both
            $table->enum('menu_type', ['admin', 'company', 'both'])->default('admin')->comment('Who can access this menu');

            // Route or URL
            $table->string('route', 255)->nullable()->comment('Laravel route name or external URL');

            // Optional Spatie permission link (backend security)
            $table->string('permission_name', 150)->nullable()->comment('Optional: link menu to Spatie permission');

            // Optional icon class
            $table->string('icon', 100)->nullable();

            // Parent menu (for nesting)
            $table->unsignedBigInteger('parent_id')->nullable()->index();

            // Sorting
            $table->integer('order')->default(0);

            // Status
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // self relation
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
        });

        Schema::dropIfExists('menus');
    }
}
