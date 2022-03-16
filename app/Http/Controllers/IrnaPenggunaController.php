<?php

namespace App\Http\Controllers;

use App\Models\IrnaRole;
use App\Models\IrnaUser;
use Illuminate\Http\Request;

class IrnaPenggunaController extends Controller
{
    
    public function index(Request $r)
    {
        if(!session('user')) return view('admin.login');
            
        $dataUser = IrnaUser::all();
        $dataBagian = IrnaRole::all();
        return view('admin.irna_user',compact('dataUser','dataBagian'));
        
    }

    public function add(Request $r)
    {
        if(!session('user')) return view('admin.login');
            
        $insert = IrnaUser::insert([
            'irna_nama'          => $r->nama,
            'irna_username'      => $r->username,
            'irna_role'          => $r->role,
            'irna_status'        => 1,
            'irna_password'      => md5(sha1(md5($r->password))),
            'created_at'         => date('Y-m-d H:i:s'),
            'updated_at'         => date('Y-m-d H:i:s'),
        ]);

        return response()->json($insert);
    }

    public function detail($id)
    {
        if(!session('user')) return view('admin.login');
            
        $detail = IrnaUser::where('id',$id)->first();
        return response()->json($detail);
        
        
    }

    public function update(Request $r)
    {
        if(!session('user')) return view('admin.login');
        $getFirstData = IrnaUser::where('id',$r->id)->first();
        $update = IrnaUser::where('id',$r->id)->update([
            'irna_nama'         => $r->nama,
            'irna_username'     => $r->username,
            'irna_role'         => $r->role,
            'irna_status'       => $r->status,
            'password'          => isset($r->password) ? md5(sha1(md5($r->password))) : $getFirstData->password,
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);

        return response()->json($update == 1 ? True : False);
    }

    public function delete(Request $r)
    {
        if(!session('user')) return view('admin.login');
        $delete = IrnaUser::where('id',$r->id)->delete();
        return response()->json($delete);
    }
}
