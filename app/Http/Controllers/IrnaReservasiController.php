<?php

namespace App\Http\Controllers;

use App\Models\IrnaGuest;
use App\Models\IrnaKamar;
use App\Models\IrnaReservasi;
use App\Models\IrnaTipe;
use Illuminate\Http\Request;
use PDF;

class IrnaReservasiController extends Controller
{
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
            'total'      => $add->irna_total,
        ];
        $pdf = PDF::loadView('irna_struk', $dataPdf);
        
        return $pdf->download('Struk Reservasi'.$add->irna_kode.'.pdf');
    }

    public function index(Request $r)
    {
        if(!session('user')) return view('admin.login');
        $dataSummary = [];
        $dataReservasi = IrnaReservasi::all();
        $dataTamu = IrnaGuest::all();
        $dataKamar = IrnaKamar::where('irna_status',1)->get();
        $dataTipe = IrnaTipe::all();

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
                'status'      => $dt->irna_status,
            ];
        }
        return view('admin.irna_reservasi',compact('dataSummary','dataTamu','dataKamar','dataTipe'));
        
    }

    public function add(Request $r)
    {
        if(!session('user')) return view('admin.login');
            
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $add  = new IrnaReservasi();
        $add->irna_kode     = $randomString;
        $add->irna_id_tamu  = $r->id_tamu;
        $add->irna_checkin  = $r->checkin;
        $add->irna_checkout = $r->checkout;
        $add->irna_pesan    = $r->pesan;
        $add->irna_no_kamar = $r->nomor;
        $add->irna_total    = $r->total;
        $add->save();

        

        $kamar = IrnaKamar::where('irna_nomor',$r->nomor)->first();
        $kamar->irna_status = 2;
        $kamar->save();

        return redirect('/data-reservasi');
    }

    public function delete(Request $r)
    {
        if(!session('user')) return view('admin.login');
        $delete = IrnaReservasi::where('id',$r->id)->update(['irna_status'   => 3]);
        $kamar = IrnaKamar::where('irna_nomor',$delete->irna_no_kamar)->update(['irna_status' => 1]);
        return response()->json($delete);
    }

    public function update(Request $r) {
        if(!session('user')) return view('admin.irna_login');
        $update = IrnaReservasi::where('id',$r->id)->update([
            'irna_status'       =>$r->status,
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
        if($r->status == 2) $update = IrnaKamar::where('irna_nomor',$update->irna_no_kamar)->update(['irna_status' => 1]);
        

        return response()->json($update == 1 ? True : False);
    }
    public function detail($id) {
        $all = [];
        $data = IrnaReservasi::where('id',$id)->first();
        $tamu = IrnaGuest::where('id',$data->irna_id_tamu)->first();
        $all = [
            'id'  => $data->id,
            'nama'  => $tamu->irna_nama,
            'kode'  => $data->irna_kode,
            'checkin'  => $data->irna_checkin,
            'checkout'  => $data->irna_checkout,
            'status'  => $data->irna_status,
        ];
        return response()->json($all);
    }
}
