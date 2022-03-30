<?php

namespace App\Http\Controllers;

use App\Models\IrnaGuest;
use App\Models\IrnaKamar;
use App\Models\IrnaReservasi;
use App\Models\IrnaRole;
use App\Models\IrnaTipe;
use App\Models\IrnaUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IrnaLoginController extends Controller
{
    public function index()
    {
        if(!session('user')) return view('admin.irna_login');

        $data = IrnaUser::all();
        $fetch = [];
        foreach($data as $dt)
        {
            $fetch [] = [
                'nama'      => $dt->name,
                'email'     => $dt->email,
                'system'    =>  $dt->system_user
            ];
        }

        $dataSummary = [];
        $dataReservasi = IrnaReservasi::all();
        if(count($dataReservasi) > 0){
            foreach($dataReservasi as $dt) { 
                $Tamu      = IrnaGuest::where('id',$dt->irna_id_tamu)->first(); 
                $Kamar     = IrnaKamar::where('irna_nomor',$dt->irna_no_kamar)->first();
                $Tipe      = IrnaTipe::where('id',$Kamar->irna_tipe)->first();

                $dataSummary[]  = [
                    'id'         => $dt->id,
                    'kode'       => $dt->irna_kode,
                    'nama'       => $Tamu->irna_nama,
                    'identitas'  => $Tamu->irna_no_identitas,
                    'telp'       => $Tamu->irna_telpon,
                    'checkin'    => $dt->irna_checkin,
                    'checkout'   => $dt->irna_checkout,
                    'no_kamar'   => $dt->irna_no_kamar,
                    'tipe'       => $Tipe->irna_nama,
                    'total'      => $dt->irna_total,
                ];
            }
        }
        return view('admin.irna_dashboard',compact('fetch','dataSummary'));
    }

    public function getData()
    {
        $fetch = [];
        $data1 = IrnaReservasi::select(DB::raw('COUNT(*) as total_hari_ini'))->where(DB::raw('DATE(created_at)'),'=',DB::raw('DATE(now())'))->first();
        $data2 = IrnaKamar::select(DB::raw('COUNT(*) as kamar_dipakai'))->where('irna_status',2)->first();
        $data3 = IrnaKamar::select(DB::raw('COUNT(*) as kamar_kosong'))->where('irna_status',1)->first();
        $data4 = IrnaReservasi::select(DB::raw('COUNT(*) as keluar'))->where(DB::raw('DATE(irna_checkout)'),'=',DB::raw('DATE(now())'))->orWhere('irna_status',2)->first();
        $total_hari_ini = $data1->total_hari_ini;
        $kamar_dipakai = $data2->kamar_dipakai;
        $kamar_kosong = $data3->kamar_kosong;
        $keluar= $data4->keluar;
        $fetch[] = [
            'total_hari_ini'     => $total_hari_ini,
            'kamar_dipakai'     => $kamar_dipakai,
            'kamar_kosong'  => $kamar_kosong,
            'keluar'   => $keluar,
        ];
        return response()->json($fetch);
    }

    public function login(Request $r)
    {
        $cekPassword = md5(sha1(md5($r->pwd)));
        $cekUser  = IrnaUser::where('irna_username',$r->username)
                    ->where('irna_password',$cekPassword)
                    ->first();
        $getBagian = IrnaRole::where('id',$cekUser->irna_role)->first();

        if(!$cekUser) return view('admin.irna_login');

        session(['user' => [
                'nama'          => $cekUser->irna_nama,
                'username'      => $cekUser->irna_username,
                'role'          => isset($getBagian->irna_nama) ? $getBagian->irna_nama : ''
            ]
        ]);
        return redirect('/dashboard');
    }

    public function logout(Request $r)
    {
        $r->session()->forget('user');
        return view('admin.irna_login');
    }
}
