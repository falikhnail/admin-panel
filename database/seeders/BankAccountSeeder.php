<?php

namespace Database\Seeders;

use App\Models\BankAccountModel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wd = [
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'users_id' => 2,
                'account_name' => 'User Aggregator Account',
                'bank_name' => 'BANK BCA',
                'account_number' => '1122334455'
            ],
        ];

        foreach ($wd as $data) {
            BankAccountModel::query()->insert($data);
        }
    }
}
