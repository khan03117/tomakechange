<?php

namespace Database\Seeders;

use App\Models\SlotTimeGap;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeGapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            [
                'current_hour' => '00:00:00',
                'hour_gap' => '10'
            ],
            [
                'current_hour' => '01:00:00',
                'hour_gap' => '9'
            ],
            [
                'current_hour' => '02:00:00',
                'hour_gap' => '8'
            ],
            [
                'current_hour' => '03:00:00',
                'hour_gap' => '7'
            ],
            [
                'current_hour' => '04:00:00',
                'hour_gap' => '6'
            ],
            [
                'current_hour' => '05:00:00',
                'hour_gap' => '5'
            ],
            [
                'current_hour' => '07:00:00',
                'hour_gap' => '4'
            ],
            [
                'current_hour' => '08:00:00',
                'hour_gap' => '4'
            ],
            [
                'current_hour' => '09:00:00',
                'hour_gap' => '4'
            ],
            [
                'current_hour' => '10:00:00',
                'hour_gap' => '3'
            ],
            [
                'current_hour' => '11:00:00',
                'hour_gap' => '3'
            ],
            [
                'current_hour' => '12:00:00',
                'hour_gap' => '3'
            ],
            [
                'current_hour' => '13:00:00',
                'hour_gap' => '3'
            ],
            [
                'current_hour' => '14:00:00',
                'hour_gap' => '3'
            ],
            [
                'current_hour' => '15:00:00',
                'hour_gap' => '3'
            ],
            [
                'current_hour' => '16:00:00',
                'hour_gap' => '4'
            ],
            [
                'current_hour' => '17:00:00',
                'hour_gap' => '3'
            ],
            [
                'current_hour' => '18:00:00',
                'hour_gap' => '3'
            ],
            [
                'current_hour' => '19:00:00',
                'hour_gap' => '3'
            ],
            [
                'current_hour' => '20:00:00',
                'hour_gap' => '3'
            ],
            [
                'current_hour' => '21:00:00',
                'hour_gap' => '13'
            ],
            [
                'current_hour' => '22:00:00',
                'hour_gap' => '12'
            ],
            [
                'current_hour' => '23:00:00',
                'hour_gap' => '11'
            ],
        ];
        foreach ($arr as $item) {
            SlotTimeGap::insert($item);
        }
    }
}
