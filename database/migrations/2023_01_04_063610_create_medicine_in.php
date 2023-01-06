<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineIn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_ins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_in_id')->unsigned()->nullable();
            $table->bigInteger('medicine_id')->unsigned();
            $table->bigInteger('unit_id')->unsigned();
            $table->date('expired_date');
            $table->integer('qty')->default(0);
            $table->integer('price')->default(0);
            $table->integer('total')->default(0);
            $table->timestamps();
            $table->foreign('transaction_in_id')->references('id')->on('transaction_ins');
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_ins');
    }
}
