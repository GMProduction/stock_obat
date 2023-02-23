<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockAdjusmentDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_adjustment_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stock_adjustment_id')->unsigned();
            $table->bigInteger('medicine_id')->unsigned();
            $table->integer('current_qty')->default(0);
            $table->integer('real_qty')->default(0);
            $table->timestamps();
            $table->foreign('stock_adjustment_id')->references('id')->on('stock_adjustments');
            $table->foreign('medicine_id')->references('id')->on('medicines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_adjustment_details');
    }
}
