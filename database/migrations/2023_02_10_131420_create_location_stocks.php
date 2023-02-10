<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('location_id')->unsigned();
            $table->bigInteger('medicine_id')->unsigned();
            $table->integer('qty')->default(0);
            $table->timestamps();
            $table->foreign('location_id')->references('id')->on('locations');
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
        Schema::dropIfExists('location_stocks');
    }
}
