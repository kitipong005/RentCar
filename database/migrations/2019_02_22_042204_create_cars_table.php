<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('license')->unique();
            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('model_id')->unsigned();
            $table->foreign('model_id')->references('id')->on('models')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');
            $table->string('seat');
            $table->string('gear');
            $table->string('door')->nullable();
            $table->string('air')->nullable()->default('no');
            $table->string('price');
            $table->integer('count')->comment('นับจำนวนรถ');
            $table->integer('status')->default(0);
            $table->longText('pic')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
