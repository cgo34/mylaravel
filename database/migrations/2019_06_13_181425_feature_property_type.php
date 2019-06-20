<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FeaturePropertyType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_property_type', function (Blueprint $table) {
            $table->integer('properties_type_id')->unsigned();
            $table->foreign('properties_type_id')->
            references('id')->on('properties_types')->onDelete('cascade');

            $table->integer('feature_id')->unsigned();
            $table->foreign('feature_id')->
            references('id')->on('features')->onDelete('cascade');

            // add the following instruction
            $table->primary(['properties_type_id', 'feature_id']);
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
