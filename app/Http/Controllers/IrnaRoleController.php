<?php

namespace App\Http\Controllers;

use App\Models\IrnaRole;
use Illuminate\Http\Request;

class IrnaRoleController extends Controller
{
    public function index(Request $r)
    {
        if(!session('user')) return view('admin.login');

        $dataBagian = IrnaRole::all();
        return view('admin.irna_role',compact('dataBagian'));
        
    }

    public function add(Request $r)
    {
        if(!session('user')) return view('admin.login');
            
        $insert = IrnaRole::insert([
            'irna_nama'          => $r->nama,
            'irna_status'        => 1,
            'created_at'         => date('Y-m-d H:i:s'),
            'updated_at'         => date('Y-m-d H:i:s'),
        ]);

        return response()->json($insert);
    }

    public function detail($id)
    {
        if(!session('user')) return view('admin.login');
            
        $detail = IrnaRole::where('id',$id)->first();
        return response()->json($detail);
        
        
    }

    public function update(Request $r)
    {
        if(!session('user')) return view('admin.login');
        $update = IrnaRole::where('id',$r->id)->update([
            'irna_nama'         => $r->nama,
            'irna_status'       => $r->status,
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);

        return response()->json($update == 1 ? True : False);
    }

    public function delete(Request $r)
    {
        if(!session('user')) return view('admin.login');
        $delete = IrnaRole::where('id',$r->id)->delete();
        return response()->json($delete);
    }
}
