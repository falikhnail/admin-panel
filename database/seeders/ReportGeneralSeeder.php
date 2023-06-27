<?php

namespace Database\Seeders;

use App\Models\ReportGeneralModel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportGeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reportG = [
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'users_id' => 2,
                'platform' => 'seeder platform 1',
                'label_name' => 'seeder label name 1',
                'artist' => 'seeder artist 1',
                'album' => 'seeder album 1',
                'title' => 'seeder title 1',
                'isrc' => 'seeder isrc 1',
                'upc' => 20000,
                'revenue' => 20.0
            ],
        ];

        foreach ($reportG as $data) {
            ReportGeneralModel::query()->insert($data);
        }
    }
}
