<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection,WithHeadings,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Report::join('user','report.user_id','=','user.no_telp')
        ->leftJoin('penyakit','report.penyakit_id','=','penyakit.id')
        ->get(['user.nama','report.user_id as no.telp','penyakit.nama as jenis jerawat','report.tanggal']);
        return $data;
    }

    public function headings(): array
    {
        return ["Nama", "No.Telepon", "Jenis Jerawat","Tanggal"];
    }

    public function columnWidths(): array
    {
        return [
            'a' => 25,
            'b' => 25,
            "c" => 25,
            "d" => 25

        ];
    }
}
