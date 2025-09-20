<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeaServiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sea_service_details', function (Blueprint $table) {
            $table->bigIncrements('id');

            // link to users
            $table->unsignedBigInteger('user_id')->nullable()->index()->comment('users.id');

            // foreign keys to ranks and ship_types
            $table->unsignedBigInteger('rank_id')->nullable()->index()->comment('ranks.id');
            $table->unsignedBigInteger('ship_type_id')->nullable()->index()->comment('ship_types.id');

            // ship / company fields
            $table->string('ship_name')->nullable();
            $table->string('company_name')->nullable();

            // tonnage: store unit (GRT/DWT) and numeric value
            $table->enum('grt_unit', ['GRT', 'DWT'])->nullable()->comment('unit for tonnage');
            $table->unsignedBigInteger('grt_value')->nullable()->comment('numeric tonnage value');

            // engine / power
            $table->string('bhp')->nullable();

            // sign on / sign off dates
            $table->date('sign_on')->nullable();
            $table->date('sign_off')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('rank_id')->references('id')->on('ranks')->nullOnDelete();
            $table->foreign('ship_type_id')->references('id')->on('ship_types')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('sea_service_details')) {
            Schema::table('sea_service_details', function (Blueprint $table) {
                try { $table->dropForeign(['rank_id']); } catch (\Throwable $e) {}
                try { $table->dropForeign(['ship_type_id']); } catch (\Throwable $e) {}
                try { $table->dropForeign(['user_id']); } catch (\Throwable $e) {}
            });
            Schema::dropIfExists('sea_service_details');
        }
    }
}
