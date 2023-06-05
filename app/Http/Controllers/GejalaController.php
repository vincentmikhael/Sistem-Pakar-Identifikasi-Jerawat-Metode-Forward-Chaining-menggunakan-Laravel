<?php

namespace App\Http\Controllers;

use App\Exports\GejalaExport;
use App\Models\Gejala;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GejalaController extends Controller
{
    public function index(){
        $data = Gejala::all();
        return view('dashboard.gejala.index',compact('data'));
    }

    public function get(){
        return Gejala::all();
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string',
        ]);

        Gejala::create($request->all());
        
        return redirect()->to('/dashboard/gejala');
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required',
        ]);

        Gejala::where('id',$request->input('id'))->update($request->except(['_token','_method','id']));

        return redirect()->to('/dashboard/gejala');
    }

    public function delete($id){
        Gejala::destroy($id);
        return redirect()->to('/dashboard/gejala');
    }

    public function export(){
        return Excel::download(new GejalaExport,'gejala.pdf',\Maatwebsite\Excel\Excel::DOMPDF);
    }
}
