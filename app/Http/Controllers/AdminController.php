<?php

namespace App\Http\Controllers;

use App\Exports\AdminExport;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index(){
        $data = Admin::all();
        return view('dashboard.admin.index',compact('data'));
    }
    public function store(Request $request){
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        Admin::create([
            "email" => $request->input('email'),
            "role" => $request->input('role'),
            "password" => Hash::make($request->input('password'))
        ]);
        
        return redirect()->to('/dashboard/admin');
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        
        $user = Admin::where(['id' => $request->input('id')]);

        $user->update([
            "email" => $request->input('email'),
            "role" => $request->input('role') ?? $user->first()->role,
            "password" => $request->input('password') ? Hash::make($request->input('password')) : $request->input('password')
        ]);

        return redirect()->to('/dashboard/admin');
    }

    public function delete($id){
        $admin = Admin::where(['id' => $id]);
        $admin->delete();
        return redirect()->to('/dashboard/admin');
    }

    public function export(){
        return Excel::download(new AdminExport,'admin.pdf',\Maatwebsite\Excel\Excel::DOMPDF);
    }
}
