<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('car_id')->unsigned();
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('landmark_id')->unsigned()->nullable();
            $table->foreign('landmark_id')->references('id')->on('landmarks')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->integer('phone_id');
            $table->foreign('phone_id')->references('code')->on('phones')->onDelete('cascade')->onUpdate('cascade');
            $table->string('phone');
            $table->string('email');
            $table->date('s_date');
            // $table->time('s_time');
            $table->integer('s_time')->unsigned()->nullable();
            $table->foreign('s_time')->references('id')->on('timestarts')->onDelete('cascade')->onUpdate('cascade');
            $table->date('e_date');
            // $table->time('e_time');
            $table->integer('e_time')->unsigned()->nullable();
            $table->foreign('e_time')->references('id')->on('timeends')->onDelete('cascade')->onUpdate('cascade');
            $table->string('addr')->nullable();
            $table->string('district')->nullable();
            $table->string('amphoe')->nullable();
            $table->string('province')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('code',6)->nullable();
            $table->integer('days')->nullable();
            $table->double('times',4,2)->nullable();
            $table->string('price');
            $table->integer('status')->default(0);
            $table->timestamp('exp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
