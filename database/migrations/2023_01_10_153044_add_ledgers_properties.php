<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLedgersProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_ledgers', function (Blueprint $table) {
            $table->bigInteger('medicine_out_id')->unsigned()->nullable()->after('medicine_in_id');
            $table->bigInteger('transaction_in_id')->unsigned()->nullable()->after('medicine_out_id');
            $table->bigInteger('transaction_out_id')->unsigned()->nullable()->after('transaction_in_id');
            $table->foreign('medicine_out_id')->references('id')->on('medicine_outs');
            $table->foreign('transaction_in_id')->references('id')->on('transaction_ins');
            $table->foreign('transaction_out_id')->references('id')->on('transaction_outs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_ledgers', function (Blueprint $table) {
            $table->dropForeign('general_ledgers_medicine_out_id_foreign');
            $table->dropForeign('general_ledgers_transaction_in_id_foreign');
            $table->dropForeign('general_ledgers_transaction_out_id_foreign');
            $table->dropColumn('medicine_out_id');
            $table->dropColumn('transaction_in_id');
            $table->dropColumn('transaction_out_id');
        });
    }
}
