<?php

use App\Models\File\FileCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFileCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_category', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('key', 100)->primary();
            $table->string('parent_key', 100)->nullable()->comment('Key of the parent category');
            $table->string('value', 150)->unique()->comment('French name of category');
        });
        Schema::table('file_category', function (Blueprint $table) {
            $table->foreign('parent_key')->references('key')->on('file_category')->onUpdate('cascade')->onDelete('cascade');
        });
        $this->fillTable();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_category');
    }
}
