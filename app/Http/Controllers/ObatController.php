<?php

namespace App\Http\Controllers;

use App\Exports\ObatExport;
use App\Models\Obat;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ObatController extends Controller
{
    public function index(){
        $data = Obat::all();
        return view('dashboard.obat.index',compact('data'));
    }

    public function get(){
        return Obat::all();
    }

    public function store(Request $request){
        $request->validate([
            'foto' => 'required|mimes:jpg,jpeg,png',
            'nama' => 'required|string',
            'deskripsi' => 'required|string'
        ]);

        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);

        Obat::create([
            "nama" => $request->input('nama'),
            "deskripsi" => $request->input('deskripsi'),
            "foto" => $filename
        ]);
        
        return redirect()->to('/dashboard/obat');
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $obat = Obat::findOrFail($request->input('id'));
        $data = $request->except(['_token','_method','id']);

        if($request->hasFile('foto')){ // jika ada foto diupload, maka timpa foto yang lama
            $filepath = public_path('uploads/' . $obat->foto);
            if (file_exists($filepath)) {
                unlink($filepath);
            }
            
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            $data['foto'] = $filename;
        }

        $obat->update($data);

        return redirect()->to('/dashboard/obat');
    }

    public function delete($id){
        $obat = Obat::findOrFail($id);
        $filepath = public_path('uploads/' . $obat->foto);
        if (file_exists($filepath)) {
            unlink($filepath);
        }
        $obat->delete();
        return redirect()->to('/dashboard/obat');
    }

    public function export(){
        return Excel::download(new ObatExport,'obat.pdf',\Maatwebsite\Excel\Excel::DOMPDF);
    }
}
