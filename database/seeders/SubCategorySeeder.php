<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = ['Anger', 'Stress, Anxiety, Depression', 'Relationship', 'Marriage Related'];
        foreach($arr as $a){
            SubCategory::insert(['category_id' => '1', 'sub_category' => $a]);
        }
        $brr = ['Elevating Confidence', 'Managing Work Place','Time Management', 'Effective Communication', 'Strengthening Relationship'];
        foreach($brr as $v){
            SubCategory::insert(['category_id' => '2', 'sub_category' => $v]);
        }
    }
}
