<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('dashboard.login');
    }

    public function auth_user(Request $request){
        User::updateOrCreate([
            'no_telp' => $request->input('no_telp')
        ],[
            'nama' => $request->input('nama')
        ]);

        return redirect()->to('/tes-online');
    }

    public function auth_admin(Request $request){
        $credentials = $request->only('email', 'password');
     
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard/penyakit');
        }
     
        return back()->with([
            'loginError' => 'email atau Password salah',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
