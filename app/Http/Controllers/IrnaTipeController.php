<?php

namespace App\Http\Controllers;

use App\Models\IrnaTipe;
use Illuminate\Http\Request;

class IrnaTipeController extends Controller
{
    public function index(Request $r)
    {
        if(!session('user')) return view('admin.login');

        $dataTipe = IrnaTipe::all();
        return view('admin.irna_tipe',compact('dataTipe'));
        
    }

    public function add(Request $r)
    {
        if(!session('user')) return view('admin.login');
            
        $insert = IrnaTipe::insert([
            'irna_nama'          => $r->nama,
            'status'             => 1,
            'created_at'         => date('Y-m-d H:i:s'),
            'updated_at'         => date('Y-m-d H:i:s'),
        ]);

        return response()->json($insert);
    }

    public function detail($id)
    {
        if(!session('user')) return view('admin.login');
            
        $detail = IrnaTipe::where('id',$id)->first();
        return response()->json($detail);
        
        
    }

    public function update(Request $r)
    {
        if(!session('user')) return view('admin.login');
        $update = IrnaTipe::where('id',$r->id)->update([
            'irna_nama'         => $r->nama,
            'status'       => $r->status,
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);

        return response()->json($update == 1 ? True : False);
    }
}
