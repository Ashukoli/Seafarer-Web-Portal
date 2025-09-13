<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    public function up()
    {
        // permissions table
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');       // permission name
            $table->string('guard_name'); // e.g. "web"
            $table->timestamps();
        });

        // roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');       // role name
            $table->string('guard_name'); // e.g. "web"
            $table->timestamps();
        });

        // role_has_permissions
        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->primary(['permission_id', 'role_id'], 'role_has_permissions_primary');

            $table->index('permission_id', 'role_has_permissions_permission_idx');
            $table->index('role_id', 'role_has_permissions_role_idx');

            $table->foreign('permission_id')
                  ->references('id')->on('permissions')
                  ->onDelete('cascade');

            $table->foreign('role_id')
                  ->references('id')->on('roles')
                  ->onDelete('cascade');
        });

        // model_has_permissions
        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');

            // polymorphic relation fields
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');

            $table->index(['model_id', 'model_type'], 'model_has_permissions_model_idx');

            $table->primary(['permission_id', 'model_id', 'model_type'], 'model_has_permissions_primary');

            $table->foreign('permission_id')
                  ->references('id')->on('permissions')
                  ->onDelete('cascade');
        });

        // model_has_roles
        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');

            // polymorphic relation fields
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');

            $table->index(['model_id', 'model_type'], 'model_has_roles_model_idx');

            $table->primary(['role_id', 'model_id', 'model_type'], 'model_has_roles_primary');

            $table->foreign('role_id')
                  ->references('id')->on('roles')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });

        Schema::table('model_has_permissions', function (Blueprint $table) {
            $table->dropForeign(['permission_id']);
        });

        Schema::table('role_has_permissions', function (Blueprint $table) {
            $table->dropForeign(['permission_id']);
            $table->dropForeign(['role_id']);
        });

        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
    }
}
