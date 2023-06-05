<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AturanExport implements FromCollection,WithHeadings,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('aturan')
        ->select('penyakit.nama', DB::raw('GROUP_CONCAT(gejala.nama SEPARATOR ",") AS penyakit'))
        ->join('penyakit','aturan.id_penyakit','=','penyakit.id')
        ->join('gejala','aturan.id_gejala','=','gejala.id')
        ->groupBy('id_penyakit')
        ->get();
    }

    public function headings(): array
    {
        return ["Nama",'Penyakit'];
    }

    public function columnWidths(): array
    {
        return [
            'a' => 30,
            'b' => 70
        ];
    }
}
