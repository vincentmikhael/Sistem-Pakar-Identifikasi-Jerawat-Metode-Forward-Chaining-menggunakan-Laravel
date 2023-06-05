<?php

namespace App\Http\Controllers;

use App\Exports\AturanExport;
use App\Models\Aturan;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AturanController extends Controller
{
    public function index(){
        $data = Penyakit::all();
        return view('dashboard.aturan.index',compact('data'));
    }
    public function get($id_penyakit){
        return Aturan::join('gejala','aturan.id_gejala','=','gejala.id')->where(["id_penyakit"=>$id_penyakit])->get(['gejala.id','gejala.nama']);
    }

    public function store(Request $request){
        Aturan::where('id_penyakit',$request->input('data')[0]['id_penyakit'])->delete();
        Aturan::upsert($request->input('data'),['id_penyakit','id_gejala'],['id_penyakit','id_gejala']);
        return redirect()->to('/dashboard/aturan');
    }

    public function export(){
        return Excel::download(new AturanExport,'aturan.pdf',\Maatwebsite\Excel\Excel::DOMPDF);
    }
}
