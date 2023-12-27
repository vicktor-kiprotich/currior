<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterShipmentSettingsTableV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $items = array(
            "key"       =>  "def_shipment_code_type",
            "value"      =>  "random",
        );
        DB::table('shipment_settings')->insert($items);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('shipment_settings', function (Blueprint $table) {
            //
        });
    }
}
