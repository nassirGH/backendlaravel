<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('title');
            $table->longText('description')->nullable();
            $table->double('amount',8,2);
            // $table->foreign('categories_id')->references('id')->on('categories');
            //$table->foreign('users_id')->references('id')->on('users');
            //$table->foreign('currencies_id')->references('id')->on('currencies');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->text('interval')->nullable();
            $table->text('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
//