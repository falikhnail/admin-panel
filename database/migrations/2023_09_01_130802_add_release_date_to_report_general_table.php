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
        Schema::table('report_general', function (Blueprint $table) {
            $table->date('release_date')->nullable()->after('reporting_period');
            $table->boolean('is_release')->nullable()->after('release_date');
            $table->integer('quantity')->nullable()->after('is_release');
            $table->integer('sales_type')->nullable()->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report_general', function (Blueprint $table) {
            $table->dropColumn('release_date');
            $table->dropColumn('is_release');
            $table->dropColumn('quantity');
            $table->dropColumn('sales_type');
        });
    }
};
