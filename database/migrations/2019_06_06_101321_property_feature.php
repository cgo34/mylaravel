<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PropertyFeature extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_feature', function (Blueprint $table) {
            $table->integer('property_id')->unsigned();
            $table->foreign('property_id')->
            references('id')->on('property')->onDelete('cascade');

            $table->integer('feature_id')->unsigned();
            $table->foreign('feature_id')->
            references('id')->on('feature')->onDelete('cascade');

            // add the following instruction
            $table->primary(['property_id', 'feature_id']);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_feature');
    }
}
