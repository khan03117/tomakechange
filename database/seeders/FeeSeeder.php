<?php

namespace Database\Seeders;

use App\Models\Conven_fee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            ['duration' => '01:00:00', 'quantity' => 1, 'mode' => 'Video', 'rate' => '2.5', 'fixed_fee' => 36],
            ['duration' => '00:30:00', 'quantity' => 1, 'mode' => 'Video', 'rate' => '2.5', 'fixed_fee' => 10],
        ];
        foreach ($arr as $a) {
            Conven_fee::insert($a);
        }
    }
}
