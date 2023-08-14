<?php

namespace Database\Seeders;

use App\Models\WithdrawModel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WithdrawsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = function ($addDate) {
            return date('Y-m-d', strtotime($addDate));
        };

        $wd = [
            [
                'users_id' => 2,
                'amount' => 35.00,
                'request_date' => $date('-2 month'),
                'status' => 'approved'
            ],
            [
                'users_id' => 2,
                'amount' => 40.00,
                'request_date' => $date('-2 month'),
                'status' => 'approved'
            ],
            [
                'users_id' => 2,
                'amount' => 31.00,
                'request_date' => $date('-1 month'),
                'status' => 'approved'
            ],
            [
                'users_id' => 2,
                'amount' => 35.00,
                'request_date' => $date('-1 month'),
                'status' => 'approved'
            ],
            [
                'users_id' => 2,
                'amount' => 30.00,
                'request_date' => $date('-1 month'),
                'status' => 'approved'
            ],
            [
                'users_id' => 2,
                'amount' => 50.00,
                'request_date' => $date('+0 day'),
                'status' => 'approved'
            ],
            [
                'users_id' => 2,
                'amount' => 50.00,
                'request_date' => $date('+0 day'),
                'status' => 'approved'
            ],
        ];

        foreach ($wd as $data) {
            WithdrawModel::query()->insert($data);
        }
    }
}
