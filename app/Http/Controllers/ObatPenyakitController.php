<?php

namespace App\Http\Controllers;

use App\Exports\ObatPenyakitExport;
use App\Models\ObatPenyakit;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ObatPenyakitController extends Controller
{
    public function index(){
        $data = Penyakit::all();
        return view('dashboard.obat_penyakit.index',compact('data'));
    }

    public function get($id_penyakit){
        // $data = ObatPenyakit::join('obat','obat.id','=','obat_penyakit.id_obat')->join('penyakit','penyakit.id','=','obat_penyakit.id_penyakit')->where(['obat_penyakit.id_penyakit'=>$id_penyakit])->get();
        $data = ObatPenyakit::where(['obat_penyakit.id_penyakit'=>$id_penyakit])->get('id_obat');
        return $data;
    }

    public function store(Request $request){
        ObatPenyakit::where('id_penyakit',$request->input('data')[0]['id_penyakit'])->delete();
        ObatPenyakit::upsert($request->input('data'),['id_penyakit','id_obat'],['id_penyakit','id_obat']);
        return redirect()->to('/dashboard/obat-penyakit');
    }

    public function get_relation($id_penyakit){
        $data = ObatPenyakit::join('obat','obat_penyakit.id_obat','=','obat.id')
        ->where(['obat_penyakit.id_Penyakit'=>$id_penyakit])->get();
        return $data;
    }

    public function export(){
        return Excel::download(new ObatPenyakitExport,'obat penyakit.pdf',\Maatwebsite\Excel\Excel::DOMPDF);
    }
}
