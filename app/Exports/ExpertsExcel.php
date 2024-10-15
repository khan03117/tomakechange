<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Expert;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class ExpertsExcel implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $items  =  Expert::where('is_verified', '1')
        ->join('posts', 'posts.id', '=', 'experts.post_id', 'left')
        ->join('categories', 'categories.id', '=', 'experts.designation')
        ->with('state')->with('city')->with('expertize')->select(['experts.*', 'posts.post', 'categories.category'])->orderBy('name', 'ASC')->get();
        return $items;
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Mobile',
            'Category',
            'Role',
            'City',
            'State',
            'Qualification',
            'Stream',
            'Exprience',
            'Therapy'
        ];
    }
    public function map($item): array
    {
        return [
            
                $item['name'],
                $item['email'],
                $item['mobile'],
                $item['category'],
                $item['post'] ?? $item['custom_postname'],
                $item['city'] ? $item['city']['city'] : "",
                $item['state'] ? $item['state']['state'] : "",
                 $item['qualification'],
                 $item['stream'],
                 $item['experience'],
                 $item['therapy']
                
        ];
    }
}
