<?php

namespace App\Exports;

use App\Models\CashMemo;
use Maatwebsite\Excel\Concerns\FromCollection;


class CashMemoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CashMemo::all();
    }
}
