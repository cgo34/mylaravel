<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigInteger('id')->autoIncrement();

            $table->string('name');
            $table->string('path');
            $table->string('type');
            $table->string('extension');

            $table->bigInteger('property_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('category_key', 100)->comment('Category linked to the file');
            $table->foreign('property_id')->references('id')->on('property');
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('category_key')->references('key')->on('file_category')->onUpdate('cascade')->onDelete('cascade');
        });

        /*Schema::table('user', function (Blueprint $table) {
            $table->foreign('thumbnail_id')->references('id')->on('file')->onDelete('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file');
    }
}
