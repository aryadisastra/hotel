<?php

namespace App\Http\Controllers;

use App\Models\IrnaAttachment;
use App\Models\IrnaKamar;
use App\Models\IrnaReservasi;
use App\Models\IrnaStruk;
use App\Models\IrnaTipe;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IrnaHomepageController extends Controller
{
    public function tipeDetail($id) {
        $getData = IrnaTipe::where(DB::raw('lower(irna_nama)'),strtolower($id))->first();
        $getDataKamar = IrnaKamar::where('irna_tipe',$getData->id)->where('irna_status',1)->get();
        $getImg  = IrnaAttachment::where('irna_id_tipe',$getData->id)->get();
        return view('homepage.irna_detail',compact('getData','getImg','getDataKamar'));
    }

    public function kamarDetail($id) {
        $getDataKamar = IrnaKamar::where('id',$id)->first();
        return view('homepage.irna_detail_kamar',compact('getDataKamar'));
    }

    public function reservasi($id) {
        if(!session('guest')) return redirect('/')->with('error','N/A');
        $data = IrnaKamar::where('id',$id)->first();
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
        return view('homepage.irna_reservasi',compact('tipe','dataNomor','data'));
    }

    public function booking(Request $r)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $add  = new IrnaReservasi();
        $add->irna_kode     = $randomString;
        $add->irna_id_tamu  = session('guest')['id'];
        $add->irna_checkin  = $r->checkin;
        $add->irna_checkout = $r->checkout;
        $add->irna_pesan    = $r->pesan;
        $add->irna_no_kamar = $r->nomor;
        $add->jumlah_tamu   = $r->jumlah_tamu;
        $add->irna_total    = $r->total;
        $add->save();

        $kamar = IrnaKamar::where('irna_nomor',$r->nomor)->first();
        $kamar->irna_status = 2;
        $kamar->save();

        $dataPdf = [
            'title'     => 'Struk Reservasi Palm Hotel',
            'NoID'     => session('guest')['no_identitas'],
            'nama'      => session('guest')['nama'],
            'kode'      => $add->irna_kode,
            'checkin'   => date('d - M - Y',strtotime($add->irna_checkin)),
            'checkout'   => date('d - M - Y',strtotime($add->irna_checkout)),
            'no_kamar'   => $add->irna_no_kamar,
            'jumlah_tamu' => $add->jumlah_tamu,
            'total'      => $add->irna_total,
        ];
        $pdf = PDF::loadView('irna_struk', $dataPdf);
        file_put_contents(public_path().'/struk/'.$add->irna_kode.'.pdf', $pdf->output() );
        $struk = new IrnaStruk();
        $struk->irna_id_tamu           = session('guest')['id'];
        $struk->irna_kode_reservasi    = $add->irna_kode;
        $struk->irna_struk             = $add->irna_kode.'.pdf';
        $struk->save();
        $result = 'success';
        return view('homepage.irna_confirmation',compact('result'));
    }
}
