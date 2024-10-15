<?php

namespace App\Exports;

use App\Models\Slot;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SessionExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $items =  Slot::with('expert:id,name,email,mobile')->with('user:id,name,email,mobile')->where('is_paid', '1')->orderBy('slot', 'DESC')->get();
        // echo json_encode($items);
        // die;
        return $items;
    }
    public function headings(): array
    {
        return [
            'Client Name',
            'Client Email',
            'Client Mobile',
            'Expert Name',
            'Expert Email',
            'Expert Mobile',
            'Start Time',
            'End Time',
            'Duration',
            'Status'
        ];
    }
    public function map($slot): array
    {
        return [
            $slot['user']['name'],
            $slot['user']['email'],
            $slot['user']['mobile'],
            $slot['expert']['name'],
            $slot['expert']['email'],
            $slot['expert']['mobile'],
            date('d-M-Y h:i A', strtotime($slot['slot'])),
            date('d-M-Y h:i A', strtotime($slot['slot_end'])),
            $slot['duration'],
            $slot['booking_status']

        ];
    }
}
