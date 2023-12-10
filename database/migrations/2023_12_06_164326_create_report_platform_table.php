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
        Schema::create('report_platform', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('users_id')->unsigned()->index()->nullable();
            $table->bigInteger('platform_id')->unsigned()->index()->nullable();

            $table->string('platform_imported', 150);
            $table->string('artist', 100);
            $table->decimal('revenue', 8, 4);
            $table->boolean('is_release')->nullable();
            $table->date('release_date')->nullable();
            $table->date('reporting_period')->nullable();

            $table->timestamps();
        });

        Schema::table('report_general', function (Blueprint $table) {
            //$table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('platform_id')->references('id')->on('platform')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_platform');
    }
};
