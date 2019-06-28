<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdvertFeature extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_feature', function (Blueprint $table) {
            $table->integer('advert_id')->unsigned();
            $table->foreign('advert_id')->
            references('id')->on('advert')->onDelete('cascade');

            $table->integer('feature_id')->unsigned();
            $table->foreign('feature_id')->
            references('id')->on('feature')->onDelete('cascade');

            // add the following instruction
            $table->primary(['advert_id', 'feature_id']);
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
