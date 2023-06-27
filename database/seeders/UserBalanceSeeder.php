<?php

namespace Database\Seeders;

use App\Models\UserBalanceModel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserBalanceSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $date = function ($addDate) {
            return date('Y-m-d H-i-s', strtotime($addDate));
        };

        $users = [
            [
                'users_id' => 2,
                'kredit' => 0,
                'debit' => 30.00,
                'balance' => 30.00,
                'keterangan' => 'Deposit',
                'created_at' => $date('-2 month'),
                'updated_at' => $date('-2 month'),
            ],
            [
                'users_id' => 2,
                'kredit' => 0,
                'debit' => 70.20,
                'balance' => 70.20,
                'keterangan' => 'Deposit',
                'created_at' => $date('-1 month'),
                'updated_at' => $date('-1 month'),
            ],
            [
                'users_id' => 2,
                'kredit' => 0,
                'debit' => 50.20,
                'balance' => 50.20,
                'keterangan' => 'Deposit',
                'created_at' => $date('+0 day'),
                'updated_at' => $date('+0 day'),
            ],
        ];

        foreach ($users as $user_data) {
            UserBalanceModel::query()->insert($user_data);
        }
    }
}
