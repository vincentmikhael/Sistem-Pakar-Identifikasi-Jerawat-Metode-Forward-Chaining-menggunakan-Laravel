<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(){
        $data = User::all();
        return view('dashboard.user.index',compact('data'));
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string',
            'no_telp' => 'required|string'
        ]);

        User::create([
            "nama" => $request->input('nama'),
            "no_telp" => $request->input('no_telp')
        ]);
        
        return redirect()->to('/dashboard/user');
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $user = User::where(['no_telp' => $request->input('id')]);
        $data = $request->except(['_token','_method','id']);

        $user->update($data);

        return redirect()->to('/dashboard/user');
    }

    public function delete($id){
        $penyakit = User::where(['no_telp' => $id]);
        $penyakit->delete();
        return redirect()->to('/dashboard/user');
    }

    public function export(){
        return Excel::download(new UserExport,'user.pdf',\Maatwebsite\Excel\Excel::DOMPDF);
    }

}
