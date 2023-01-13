<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineOuts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_outs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_out_id')->unsigned()->nullable();
            $table->bigInteger('medicine_id')->unsigned();
            $table->bigInteger('unit_id')->unsigned();
            $table->integer('qty')->default(0);
            $table->integer('price')->default(0);
            $table->integer('total')->default(0);
            $table->timestamps();
            $table->foreign('transaction_out_id')->references('id')->on('transaction_outs');
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_outs');
    }
}
