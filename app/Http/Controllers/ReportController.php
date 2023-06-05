<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Models\Report;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(){
        return view('home.report');
    }

    public function dashboard(){
        $data = Report::join('user','report.user_id','=','user.no_telp')
        ->leftJoin('penyakit','report.penyakit_id','=','penyakit.id')
        ->get(['user.nama','no_telp','penyakit.nama as penyakit','tanggal']);
        return view('dashboard.report.index',compact('data'));
    }

    public function get($user_id){
        $data = Report::join('user','report.user_id','=','user.no_telp')
        ->leftJoin('penyakit','report.penyakit_id','=','penyakit.id')
        ->where('report.user_id',$user_id)
        ->orderBy('report.id','DESC')
        ->get();
        echo json_encode($data);
    }

    public function export(){
        return Excel::download(new ReportExport,'report.pdf',\Maatwebsite\Excel\Excel::DOMPDF);
    }
}
