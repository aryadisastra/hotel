<?php

namespace App\Http\Controllers;

use App\Models\IrnaFasilitas;
use App\Models\IrnaKamar;
use App\Models\IrnaTipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class IrnaKamarController extends Controller
{
    public function index(Request $r)
    {
        if(!session('user')) return view('admin.login');

        $dataKamar = IrnaKamar::all();
        $dataTipe = IrnaTipe::where('status',1)->get();
        $dataFasilitas = IrnaFasilitas::where('irna_status',1)->get();
        return view('admin.irna_kamar',compact('dataKamar','dataTipe','dataFasilitas'));
        
    }

    public function add(Request $r)
    {
        if(!session('user')) return view('admin.login');
        $add = new IrnaKamar();
        $add->irna_nomor        = $r->nomor;
        $add->irna_lantai       = $r->lantai;
        $add->irna_tipe         = $r->tipe;
        $add->irna_maximal      = $r->kapasitas;
        $add->irna_harga        = $r->harga;
        $add->irna_status       = 1;
        $add->irna_fasilitas    = implode($r->fasilitas);
        $files = $r->file('foto');
        if ($r->hasFile('foto')) {
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $imageExt =  $file->getClientOriginalExtension();
                $file_name_convert = IrnaKamar::generateNameImages();
                $images_true = $file_name_convert . '.' . $imageExt;
                $custom_env = IrnaKamar::moveImage($file, $images_true);
                if ($custom_env !== false) {
                    $add->irna_foto              = $images_true;
                }
            }
        }
        $add->save();

        return redirect('/kamar');
    }

    public function detail($id)
    {
        if(!session('user')) return view('admin.login');
            
        $detail = IrnaKamar::where('id',$id)->first();
        return response()->json($detail);
        
        
    }

    public function update(Request $r)
    {
        if(!session('user')) return view('admin.login');
        $update = IrnaKamar::where('id',$r->id)->update([
            'irna_nama'         => $r->nama,
            'irna_status'       => $r->status,
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);

        return response()->json($update == 1 ? True : False);
    }
}
