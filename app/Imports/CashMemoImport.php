<?php

namespace App\Imports;

use App\Models\Area;
use App\Models\CashMemo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CashMemoImport implements ToCollection, SkipsOnFailure
{


    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.7' => 'required',
        ])->validate();

        foreach ($rows as $row) {
            $arr = explode('/', $row[4]);
            $area = $row[1];
            $check = Area::where('area', $area)->first();
            if (!$check) {
                $aid =  Area::insertGetId(['area' => $area]);
            } else {
                $aid = $check['id'];
            }
            $cid = $row[7];
            $idp = CashMemo::where('cm_number', $cid)->first();
            if (!$idp) {
                CashMemo::create([
                    'area_id' => $aid,
                    'area' => $row[1],
                    'cm_date' => $arr[2] . '-' . $arr[1] . '-' . $arr[0],
                    'cm_number' => $row[7],
                    'consumer_id' => $row[9],
                    'name' => $row[10],
                    'address' => $row[11] . ' ' . $row[12] . ' ' . $row[13],
                    'mobile' => $row[14],
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
    }
    public function onFailure(Failure ...$failures)
    {
        // Handle the failures how you'd like.
    }
}
