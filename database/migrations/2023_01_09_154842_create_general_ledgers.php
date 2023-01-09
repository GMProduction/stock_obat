<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralLedgers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_ledgers', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->bigInteger('medicine_in_id')->unsigned();
            $table->integer('qty')->default(0);
            $table->smallInteger('type')->default(0)->comment('0: Debit, 1: Credit');
            $table->text('description')->default('-');
            $table->timestamps();
            $table->foreign('medicine_in_id')->references('id')->on('medicine_ins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_ledgers');
    }
}
