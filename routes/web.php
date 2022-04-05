<?php

use App\Models\IrnaAttachment;
use App\Models\IrnaGuest;
use App\Models\IrnaKamar;
use App\Models\IrnaReservasi;
use App\Models\IrnaStruk;
use App\Models\IrnaTipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    if(!session('guest')) return view('homepage.irna_index')->with('error','N/A');
    $dataNomor = [];
    $tipe = IrnaTipe::where('status',1)->get();
    foreach($tipe as $dt){
        $nomor = IrnaKamar::where('irna_status',1)->where('irna_tipe',$dt->id)->get();
        foreach($nomor as $dt){
            $dataNomor[] = [
                'nomor'=> $dt->irna_nomor,
            ];
        }
    }   
    return view('homepage.irna_index',compact('tipe','dataNomor'));
});

Route::post('/homepage/login', function(Request $r) {
    DB::beginTransaction();
    try{
        $cekPassword = md5(sha1(md5($r->pwd)));
        $cekUser  = IrnaGuest::where('irna_username',$r->username)
                    ->where('irna_password',$cekPassword)
                    ->first();

        if(!$cekUser) return view('homepage.irna_index')->with('error','invalid');;

        session(['guest' => [
                'id'            => $cekUser->id,
                'nama'          => $cekUser->irna_nama,
                'username'      => $cekUser->irna_username,
                'no_identitas'  => $cekUser->irna_no_identitas,
                'email'         => $cekUser->irna_email,
                'telpon'        => $cekUser->irna_telpon,
            ]
        ]);
        return view('homepage.irna_confirmation');
    } catch(Exception $e)
    {
        return view('homepage.irna_index');
    }
});

Route::get('/reservasi', function() {
    return redirect('/');
});

Route::get('/welcome', function() {
    return view('homepage.irna_confirmation');
});

Route::get('/download-struk',function() {
    $struk = IrnaStruk::where('irna_id_tamu',session('guest')['id'])->orderBy('id','DESC')->first();
    $filepath = public_path().'/struk/'.$struk->irna_kode_reservasi.'.pdf';
    return Response()->download($filepath);
});

Route::get('/history', function () {
    $dataHistory = IrnaReservasi::where('irna_id_tamu',session('guest')['id'])->get();
    return view('homepage.irna_history',compact('dataHistory'));
});

Route::get('/homepage/getNomor/{id}',function($id){
    $dataNomor = IrnaKamar::where('irna_tipe',$id)->where('irna_status',1)->get();
    return response()->json($dataNomor);
});

Route::get('/homepage/getKapasitas/{id}',function($id){
    $dataKapasitas = IrnaKamar::where('irna_nomor',$id)->first();
    return response()->json($dataKapasitas);
});

Route::get('/homepage/getHarga/{nomor}',function($nomor){
    $dataKapasitas = IrnaKamar::where('irna_nomor',$nomor)->where('irna_status',1)->first();
    return response()->json($dataKapasitas);
});

Route::get('/daftar-guest',function(){
    $action = 'regis';
    return view('homepage.irna_index',compact('action'));
});

Route::post('/homepage/reservasi', 'IrnaReservasiController@booking');

Route::get('/homepage/logout',function(Request $r){
    
    $r->session()->forget('guest');
    return redirect('/');
});

Route::post('/homepage/registrasi', function(Request $r)
{

    $add = new IrnaGuest();
    $add->irna_no_identitas     = $r->no_identitas;
    $add->irna_nama             = $r->nama;
    $add->irna_email            = $r->email;
    $add->irna_username         = $r->username;
    $add->irna_telpon           = $r->telpon;
    $add->irna_password         = md5(sha1(md5($r->password)));
    $add->save();

    session(['guest' => [
            'id'          => $add->id,
            'nama'          => $add->irna_nama,
            'username'      => $add->irna_username,
            'no_identitas'  => $add->irna_no_identitas,
            'email'         => $add->irna_email,
            'telpon'        => $add->irna_telpon,
        ]
    ]);
    
    return redirect('/');
});

Route::get('/homepage/tipe/{id}', 'IrnaHomepageController@tipeDetail');
Route::get('/homepage/kamar/{id}', 'IrnaHomepageController@kamarDetail');
Route::get('/homepage/reservasi/{id}','IrnaHomepageController@reservasi');
Route::post('/homepage/reservasi-kamar','IrnaHomepageController@booking');

Route::get('/logout', 'IrnaLoginController@logout');
Route::get('/admin', 'IrnaLoginController@index');
Route::get('/admin/login', 'IrnaLoginController@login');
Route::get('/dashboard','IrnaLoginController@index');
Route::get('/dashboard/getData','IrnaLoginController@getData');

Route::get('/pengguna','IrnaPenggunaController@index');
Route::post('/pengguna','IrnaPenggunaController@add');
Route::get('/pengguna/{id}','IrnaPenggunaController@detail');
Route::put('/pengguna','IrnaPenggunaController@update');
Route::put('/pengguna','IrnaPenggunaController@delete');

Route::get('/role','IrnaRoleController@index');
Route::post('/role','IrnaRoleController@add');
Route::get('/role/{id}','IrnaRoleController@detail');
Route::put('/role','IrnaRoleController@update');
Route::put('/role','IrnaRoleController@delete');

Route::get('/fasilitas','IrnaFasilitasController@index');
Route::post('/fasilitas','IrnaFasilitasController@add');
Route::get('/fasilitas/{id}','IrnaFasilitasController@detail');
Route::put('/fasilitas','IrnaFasilitasController@update');
Route::put('/fasilitas','IrnaFasilitasController@delete');

Route::get('/tipe','IrnaTipeController@index');
Route::post('/tipe','IrnaTipeController@add');
Route::get('/tipe/{id}','IrnaTipeController@detail');
Route::put('/tipe','IrnaTipeController@update');
Route::put('/tipe','IrnaTipeController@delete');

Route::get('/kamar','IrnaKamarController@index');
Route::post('/kamar','IrnaKamarController@add');
Route::get('/kamar/{id}','IrnaKamarController@detail');
Route::post('/kamar/edit','IrnaKamarController@update');
Route::put('/kamar','IrnaKamarController@delete');

Route::get('/data-tamu','IrnaTamuController@index');
Route::post('/data-tamu','IrnaTamuController@add');
Route::get('/data-tamu/{id}','IrnaTamuController@detail');
Route::post('/data-tamu/edit','IrnaTamuController@update');
Route::put('/data-tamu','IrnaTamuController@delete');

Route::get('/data-reservasi','IrnaReservasiController@index');
Route::post('/data-reservasi','IrnaReservasiController@add');
Route::get('/data-reservasi/{id}','IrnaReservasiController@detail');
Route::put('/data-reservasi','IrnaReservasiController@delete');
Route::put('/data-reservasi/edit','IrnaReservasiController@update');