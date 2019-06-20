<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_properties', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->
            references('id')->on('user')->onDelete('cascade');

            $table->integer('property_id')->unsigned();
            $table->foreign('property_id')->
            references('id')->on('property')->onDelete('cascade');

            // add the following instruction
            $table->primary(['user_id', 'property_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_properties');
    }
}
