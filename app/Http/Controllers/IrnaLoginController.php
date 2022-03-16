<?php

namespace App\Http\Controllers;

use App\Models\IrnaRole;
use App\Models\IrnaUser;
use Illuminate\Http\Request;

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
        return view('admin.irna_dashboard',compact('fetch'));
    }

    public function getData()
    {
        // $fetch = [];
        // $data1 = DataLab::select(DB::raw('COUNT(*) as total'))->first();
        // $data2 = DataLab::select(DB::raw('COUNT(*) as belum'))->where('status',1)->first();
        // $data3 = DataLab::select(DB::raw('COUNT(*) as menunggu'))->where('status',2)->first();
        // $data4 = DataLab::select(DB::raw('COUNT(*) as selesai'))->where('status',3)->first();
        // $total = $data1->total;
        // $belum = $data2->belum;
        // $menunggu = $data3->menunggu;
        // $selesai = $data4->selesai;
        // $fetch[] = [
        //     'total'     => $total,
        //     'belum'     => $belum,
        //     'menunggu'  => $menunggu,
        //     'selesai'   => $selesai,
        // ];
        // return response()->json($fetch);
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
