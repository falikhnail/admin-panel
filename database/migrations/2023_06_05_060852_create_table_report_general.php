<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('report_general', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id')->unsigned()->index()->nullable();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('reporting_period')->default(date('Y-m-d'));
            $table->string('platform', 100);
            $table->string('label_name', 100);
            $table->string('artist', 100);
            $table->string('album', 100);
            $table->string('title', 100);
            $table->string('isrc', 50);
            $table->bigInteger('upc');
            $table->decimal('revenue');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('report_general');
    }
};
