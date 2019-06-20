<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PropertyService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_service', function (Blueprint $table) {
            $table->integer('property_id')->unsigned();
            $table->foreign('property_id')->
            references('id')->on('property')->onDelete('cascade');

            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->
            references('id')->on('service')->onDelete('cascade');

            // add the following instruction
            $table->primary(['property_id', 'service_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_service');
    }
}
