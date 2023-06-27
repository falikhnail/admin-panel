<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_balance', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id')->unsigned()->index()->nullable();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

            //$table->bigInteger('bank_account_id')->unsigned()->index()->nullable();
            //$table->foreign('bank_account_id')->references('id')->on('bank_account')->onDelete('cascade');

            $table->decimal('kredit');
            $table->decimal('debit');
            $table->decimal('balance');
            $table->string('keterangan', 200);
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
        Schema::dropIfExists('users_balance');
    }
};
