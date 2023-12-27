<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('street_address_map')->nullable();
            $table->text('lat')->nullable();
            $table->text('lng')->nullable();
            $table->text('url')->nullable();
            $table->unsignedBigInteger('mission_id')->nullable();
            $table->integer('mission_status_id');
            $table->unsignedBigInteger('shipment_id')->nullable();
            $table->integer('shipment_status_id');
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
        Schema::dropIfExists('mission_locations');
    }
}
