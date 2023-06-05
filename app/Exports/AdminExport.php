<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminExport implements FromCollection,WithHeadings,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Admin::get(['email','role']);
    }

    public function headings(): array
    {
        return ["Email",'Role'];
    }

    public function columnWidths(): array
    {
        return [
            'a' => 50,
            'b' => 50
        ];
    }
}
