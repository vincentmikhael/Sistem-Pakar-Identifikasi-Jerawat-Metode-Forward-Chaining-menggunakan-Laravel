<?php

namespace App\Exports;

use App\Models\Obat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ObatExport implements FromCollection,WithHeadings,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Obat::get(['nama','deskripsi']);
    }
    public function headings(): array
    {
        return ["Nama","Deskripsi"];
    }

    public function columnWidths(): array
    {
        return [
            'a' => 30,
            'b' => 70
        ];
    }
}
