<?php

namespace App\Http\Controllers;

use App\Models\IrnaFasilitas;
use Illuminate\Http\Request;

class IrnaFasilitasController extends Controller
{
    public function index(Request $r)
    {
        if(!session('user')) return view('admin.login');

        $dataFasilitas = IrnaFasilitas::all();
        return view('admin.irna_fasilitas',compact('dataFasilitas'));
        
    }

    public function add(Request $r)
    {
        if(!session('user')) return view('admin.login');
        $allData = explode(',',$r->nama);
        foreach($allData as $dt)
        {
            $insert = IrnaFasilitas::insert([
                'irna_nama'          => ucWords($dt),
                'irna_status'        => 1,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ]);
        }

        return response()->json($insert);
    }

    public function detail($id)
    {
        if(!session('user')) return view('admin.login');
            
        $detail = IrnaFasilitas::where('id',$id)->first();
        return response()->json($detail);
        
        
    }

    public function update(Request $r)
    {
        if(!session('user')) return view('admin.login');
        $update = IrnaFasilitas::where('id',$r->id)->update([
            'irna_nama'         => ucWords($r->nama),
            'irna_status'       => $r->status,
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);

        return response()->json($update == 1 ? True : False);
    }
}
