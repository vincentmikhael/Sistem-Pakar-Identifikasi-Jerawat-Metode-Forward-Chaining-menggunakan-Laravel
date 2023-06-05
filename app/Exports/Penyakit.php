<?php

namespace App\Exports;

use App\Models\Penyakit as Model;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Penyakit implements FromCollection,WithHeadings,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Model::get(['nama','penjelasan','tindakan']);
    }

    public function headings(): array
    {
        return ["Nama", "Penjelasan", "Tindakan"];
    }

    public function columnWidths(): array
    {
        return [
            'a' => 30,
            'b' => 35,
            "c" => 35

        ];
    }
}
