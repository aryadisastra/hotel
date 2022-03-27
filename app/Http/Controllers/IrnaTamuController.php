<?php

namespace App\Http\Controllers;

use App\Models\IrnaGuest;
use Illuminate\Http\Request;

class IrnaTamuController extends Controller
{
    public function index(Request $r)
    {
        if(!session('user')) return view('admin.login');
            
        $dataUser = IrnaGuest::all();
        return view('admin.irna_tamu',compact('dataUser'));
        
    }

    public function add(Request $r)
    {
        if(!session('user')) return view('admin.login');
            
        $insert = IrnaGuest::insert([
            'irna_no_identitas'          => $r->no_id,
            'irna_nama'                  => $r->nama,
            'irna_email'                 => $r->email,
            'irna_username'              => $r->username,
            'irna_password'              => md5(sha1(md5($r->password))),
            'irna_telpon'                => $r->telpon,
            'created_at'                 => date('Y-m-d H:i:s'),
            'updated_at'                 => date('Y-m-d H:i:s'),
        ]);

        return response()->json($insert);
    }

    public function detail($id)
    {
        if(!session('user')) return view('admin.login');
            
        $detail = IrnaGuest::where('id',$id)->first();
        return response()->json($detail);
        
        
    }

    public function update(Request $r)
    {
        if(!session('user')) return view('admin.login');
        $getFirstData = IrnaGuest::where('id',$r->id)->first();
        $update = IrnaGuest::where('id',$r->id)->update([
            'irna_no_identitas' => $r->no_id,
            'irna_nama'         => $r->nama,
            'irna_username'     => $r->username,
            'irna_email'        => $r->email,
            'irna_telpon'       => $r->telpon,
            'irna_password'          => isset($r->password) ? md5(sha1(md5($r->password))) : $getFirstData->password,
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);

        return response()->json($update == 1 ? True : False);
    }

    public function delete(Request $r)
    {
        if(!session('user')) return view('admin.login');
        $delete = IrnaGuest::where('id',$r->id)->delete();
        return response()->json($delete);
    }
}
