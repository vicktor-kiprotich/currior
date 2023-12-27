<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddressClientTableV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_client', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->text('address')->nullable();

            $table->integer('country_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->integer('area_id')->unsigned()->nullable();

            $table->text('client_street_address_map')->nullable();
            $table->text('client_lat')->nullable();
            $table->text('client_lng')->nullable();
            $table->text('client_url')->nullable();
            
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
        Schema::table('address_client', function (Blueprint $table) {
            //
        });
    }
}
