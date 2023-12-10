<?php

namespace Database\Seeders;

use App\Models\ReportArtistModel;
use App\Models\ReportChannelModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $this->call(UserSeeder::class);
        $this->call(PlatformsSeeder::class);
        $this->call(ReportGeneralSeeder::class);
        $this->call(WithdrawsSeeder::class);
        $this->call(UserBalanceSeeder::class);
        $this->call(BankAccountSeeder::class);

        // ReportArtistModel::factory(10)->create();
        // ReportChannelModel::factory(10)->create();

        Schema::enableForeignKeyConstraints();
    }
}
