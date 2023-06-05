<?php

namespace App\Exports;

use App\Models\Gejala;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GejalaExport implements FromCollection,WithHeadings,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Gejala::get('nama');
    }

    public function headings(): array
    {
        return ["Nama"];
    }

    public function columnWidths(): array
    {
        return [
            'a' => 100,

        ];
    }
}
