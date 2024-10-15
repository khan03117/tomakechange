<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class UserExcel implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $items  =  User::where('designation', 'User')
        ->join('states', 'states.id', '=', 'users.state_id')
        ->join('cities', 'cities.id', '=', 'users.city_id')
        ->select(['users.*', 'states.state', 'cities.city'])
       ->orderBy('users.name', 'ASC')->get();
        return $items;
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Mobile',
            'City',
            'State',
            'Pincode',
            'Age',
            'Gender',
           
        ];
    }
    public function map($item): array
    {
        return [
            
                $item['name'],
                $item['email'],
                $item['mobile'],
                $item['city'],
                $item['state'],
                $item['pincode'],
                $item['age'],
                $item['gender'],
              
               
                
        ];
    }
}
