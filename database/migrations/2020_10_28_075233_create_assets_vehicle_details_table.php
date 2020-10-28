<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsVehicleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets_vehicle_details', function (Blueprint $table) {
            $table->id();
            $table->integer('asset_id');
            $table->string('reg_no');
            $table->string('engine_no');
            $table->string('chasis_no');
            $table->string('color');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets_vehicle_details');
    }
}
