<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SistemController extends Controller
{
    public function sistem(Request $request){
        $data = Aturan::all();

        $aturan = [];
        foreach($data as $a){
            if(!isset($aturan[$a->id_penyakit])){
                $aturan[$a->id_penyakit] = [];
            }
            array_push($aturan[$a->id_penyakit],$a->id_gejala);
        }
        
        $gejala = [];
        foreach($request->input('jawaban') as $jwb){
            if($jwb['value'] == 'ya'){
                array_push($gejala,$jwb['id_gejala']);
            }
        }

        $hasil = [];
        foreach($aturan as $key => $rules){
            foreach($gejala as $value){
                if(in_array($value,$rules)){
                    if(!isset($hasil[$key])){
                        $hasil[$key] = 1;
                    }else{
                        $hasil[$key] = $hasil[$key] + 1;
                    }
                }
            }
        }

        $penyakit = 0;
        if(count($hasil) > 0){
            $max_keys = array_keys($hasil, max($hasil));
            $penyakit = $max_keys[0];
        }
        Report::insert([
            'penyakit_id' => $penyakit,
            'user_id' => $request->input('no_telp'),
            'tanggal' => date('Y-m-d')
        ]);
    }
}
