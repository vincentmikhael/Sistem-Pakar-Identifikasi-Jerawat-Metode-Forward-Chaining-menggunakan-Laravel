<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AturanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ObatPenyakitController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SistemController;
use App\Http\Controllers\TesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class,'index']);
Route::get('/tes-online',[TesController::class,'index']);
Route::get('/report',[ReportController::class,'index']);
Route::get('/dashboard/login',[AuthController::class,'index']);
Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard/home',[HomeController::class,'dashboard']);
    Route::get('/dashboard/penyakit',[PenyakitController::class,'index']);
    Route::get('/dashboard/gejala',[GejalaController::class,'index']);
    Route::get('/dashboard/obat',[ObatController::class,'index']);
    Route::get('/dashboard/obat-penyakit',[ObatPenyakitController::class,'index']);
    Route::get('/dashboard/aturan',[AturanController::class,'index']);
    Route::get('/dashboard/report',[ReportController::class,'dashboard']);
    Route::get('/dashboard/user',[UserController::class,'index']);
    Route::get('/dashboard/admin',[AdminController::class,'index']);

    Route::get('/export-penyakit',[PenyakitController::class,'export']);
    Route::get('/export-report',[ReportController::class,'export']);
    Route::get('/export-gejala',[GejalaController::class,'export']);
    Route::get('/export-obat',[ObatController::class,'export']);
    Route::get('/export-aturan',[AturanController::class,'export']);
    Route::get('/export-obat_penyakit',[ObatPenyakitController::class,'export']);
    Route::get('/export-user',[UserController::class,'export']);
    Route::get('/export-admin',[AdminController::class,'export']);
});

//data api
Route::get('/get-obat',[ObatController::class,'get']);
Route::get('/get-penyakit',[PenyakitController::class,'get']);
Route::get('/get-gejala',[GejalaController::class,'get']);
Route::get('/get-aturan/{id_penyakit}',[AturanController::class,'get']);
Route::get('/get-obat-penyakit/{id_penyakit}',[ObatPenyakitController::class,'get']);
Route::get('/get-report/{user_id}',[ReportController::class,'get']);
Route::get('/get-obat-penyakit-relation/{id_penyakit}',[ObatPenyakitController::class,'get_relation']);

Route::post('/penyakit',[PenyakitController::class,'store'])->name('store.penyakit');
Route::post('/gejala',[GejalaController::class,'store'])->name('store.gejala');
Route::post('/obat',[ObatController::class,'store'])->name('store.obat');
Route::post('/obat-penyakit',[ObatPenyakitController::class,'store']);
Route::post('/aturan',[AturanController::class,'store']);
Route::post('/sistem',[SistemController::class,'sistem']);
Route::post('/auth-user',[AuthController::class,'auth_user']);
Route::post('/user',[UserController::class,'store']);
Route::post('/admin',[AdminController::class,'store']);
Route::post('/login-admin',[AuthController::class,'auth_admin'])->name('login.admin');
Route::get('/logout',[AuthController::class,'logout']);

Route::put('/gejala',[GejalaController::class,'update'])->name('update.gejala');
Route::put('/obat',[ObatController::class,'update'])->name('update.obat');
Route::put('/penyakit',[PenyakitController::class,'update'])->name('update.penyakit');
Route::put('/user',[UserController::class,'update'])->name('update.user');
Route::put('/admin',[AdminController::class,'update']);

Route::delete('/gejala/{id}',[GejalaController::class,'delete'])->name('delete.gejala');
Route::delete('/obat/{id}',[ObatController::class,'delete'])->name('delete.obat');
Route::delete('/penyakit/{id}',[PenyakitController::class,'delete'])->name('delete.penyakit');
Route::delete('/user/{id}',[UserController::class,'delete']);
Route::delete('/admin/{id}',[AdminController::class,'delete']);
