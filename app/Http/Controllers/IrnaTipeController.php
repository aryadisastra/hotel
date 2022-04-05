<?php

namespace App\Http\Controllers;

use App\Models\IrnaAttachment;
use App\Models\IrnaKamar;
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
        $add = new IrnaTipe();
        $add->irna_nama     = $r->nama; 
        $add->status        = 1;
        $add->save();

        $files = $r->file('foto');
        if ($r->hasFile('foto')) {
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $imageExt =  $file->getClientOriginalExtension();
                $file_name_convert = IrnaAttachment::generateNameImages();
                $images_true = $file_name_convert . '.' . $imageExt;
                $custom_env = IrnaAttachment::moveImage($file, $images_true);
                if ($custom_env !== false) {
                    $addImg = new IrnaAttachment();
                    $addImg->irna_id_tipe              = $add->id;
                    $addImg->irna_file                 = $images_true;
                    $addImg->save();
                }
            }
        }
        // $insert = IrnaTipe::insert([
        //     'irna_nama'          => $r->nama,
        //     'status'             => 1,
        //     'created_at'         => date('Y-m-d H:i:s'),
        //     'updated_at'         => date('Y-m-d H:i:s'),
        // ]);

        return redirect('/tipe');
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

    public function delete(Request $r)
    {
        if(!session('user')) return view('admin.login');
        $delete = IrnaTipe::where('id',$r->id)->delete();
        IrnaAttachment::where('irna_id_tipe',$r->id)->delete();
        return response()->json($delete);
    }
}
