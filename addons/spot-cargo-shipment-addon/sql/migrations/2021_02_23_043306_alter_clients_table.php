<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->double('pickup_cost')->default(0);
            $table->double('supply_cost')->default(0);

            $table->double('def_mile_cost')->default(0);
            $table->double('def_shipping_cost')->default(0);
            $table->double('def_tax')->default(0);
            $table->double('def_insurance')->default(0);
            $table->double('def_return_mile_cost')->default(0);
            $table->double('def_return_cost')->default(0);

            $table->double('def_shipping_cost_gram')->default(0);
            $table->double('def_mile_cost_gram')->default(0);
            $table->double('def_tax_gram')->default(0);
            $table->double('def_insurance_gram')->default(0);
            $table->double('def_return_cost_gram')->default(0);
            $table->double('def_return_mile_cost_gram')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            //
        });
    }
}
