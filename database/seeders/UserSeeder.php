<?php

namespace Database\Seeders;

use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nama' => 'Admin Aggregator',
                'email' => 'admin@mail.com',
                'password' => 'admin',
                'tipe_user' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'User Aggregator',
                'email' => 'user@mail.com',
                'password' => 'user',
                'tipe_user' => 'user',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'User Aggregator 2',
                'email' => 'user2@mail.com',
                'password' => 'user',
                'tipe_user' => 'user',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($users as $user_data) {
            UserModel::create($user_data);
        }
    }
}
