<?php

namespace App\Exports;

use App\Models\ObatPenyakit;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ObatPenyakitExport implements FromCollection, WithHeadings, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('obat_penyakit')
        ->select('penyakit.nama', DB::raw('GROUP_CONCAT(obat.nama SEPARATOR ",") AS penyakit'))
        ->join('penyakit','obat_penyakit.id_penyakit','=','penyakit.id')
        ->join('obat','obat_penyakit.id_obat','=','obat.id')
        ->groupBy('id_penyakit')
        ->get();
    }

    public function headings(): array
    {
        return ["Nama",'Obat'];
    }

    public function columnWidths(): array
    {
        return [
            'a' => 30,
            'b' => 70
        ];
    }
}
