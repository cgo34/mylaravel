<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PropertyDispositif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_dispositif', function (Blueprint $table) {
            $table->integer('property_id')->unsigned();
            $table->foreign('property_id')->
            references('id')->on('property')->onDelete('cascade');

            $table->integer('dispositif_id')->unsigned();
            $table->foreign('dispositif_id')->
            references('id')->on('dispositif')->onDelete('cascade');

            // add the following instruction
            $table->primary(['property_id', 'dispositif_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_dispositif');
    }
}
