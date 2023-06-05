<?php

namespace App\Http\Controllers;

use App\Exports\Penyakit as ExportsPenyakit;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDO;

class PenyakitController extends Controller
{
    public function index(){
        $data = Penyakit::all();
        return view('dashboard.penyakit.index',compact('data'));
    }

    public function get(){
        return Penyakit::all();
    }

    public function store(Request $request){
        $request->validate([
            'foto' => 'required|mimes:jpg,jpeg,png',
            'nama' => 'required|string',
            'penjelasan' => 'required|string',
            'tindakan' => 'required|string'
        ]);

        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);

        Penyakit::create([
            "nama" => $request->input('nama'),
            "penjelasan" => $request->input('penjelasan'),
            "tindakan" => $request->input('tindakan'),
            "foto" => $filename
        ]);
        
        return redirect()->to('/dashboard/penyakit');
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $penyakit = Penyakit::findOrFail($request->input('id'));
        $data = $request->except(['_token','_method','id']);

        if($request->hasFile('foto')){ // jika ada foto diupload, maka timpa foto yang lama
            $filepath = public_path('uploads/' . $penyakit->foto);
            if (file_exists($filepath)) {
                unlink($filepath);
            }
            
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            $data['foto'] = $filename;
        }

        $penyakit->update($data);

        return redirect()->to('/dashboard/penyakit');
    }

    public function delete($id){
        $penyakit = Penyakit::findOrFail($id);
        $filepath = public_path('uploads/' . $penyakit->foto);
        if (file_exists($filepath)) {
            unlink($filepath);
        }
        $penyakit->delete();
        return redirect()->to('/dashboard/penyakit');
    }

    public function export(){
        return Excel::download(new ExportsPenyakit,'penyakit.pdf',\Maatwebsite\Excel\Excel::DOMPDF);
    }
}
