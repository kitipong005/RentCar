<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('book_id')->unsigned()->nullable();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->string('bank');
            $table->string('payment')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('price');
            $table->longText('pic')->nullable();
            $table->integer('status')->default(0)->comment('1 = ยืนยันการจ่ายเงิน, 2 = ยืนยันการส่งรถ, 3 = ยืนยันการส่งรถคืน');
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
        Schema::dropIfExists('payments');
    }
}
