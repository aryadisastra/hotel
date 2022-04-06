<?php

namespace App\Http\Controllers;

use App\Models\IrnaGuest;
use App\Models\IrnaKamar;
use App\Models\IrnaReservasi;
use App\Models\IrnaTipe;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class IrnaReportController extends FPDF
{
	protected $fpdf;
 
    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }
    
    function letak($gambar){
        //memasukkan gambar untuk header
        $this->fpdf->Image($gambar,10,10,20,25,null,null);
        //menggeser posisi sekarang
    }

    function garis(){
        $this->fpdf->SetLineWidth(1);
        $this->fpdf->Line(10,36,138,36);
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(10,37,138,37);
    }

    function judul($teks1, $teks2, $teks3){
        $this->fpdf->Cell(25);
        $this->fpdf->SetFont('Times','B','12');
        $this->fpdf->Cell(0,5,$teks1,0,1,'C');
        $this->fpdf->Cell(25);
        $this->fpdf->SetFont('Times','I','11');
        $this->fpdf->Cell(0,5,$teks2,0,1,'C');
        $this->fpdf->Cell(25);
        $this->fpdf->Cell(0,5,$teks3,0,1,'C');
    }
    
    public function print() 
    {
        
        $dataSummary = [];
        $dataReservasi = IrnaReservasi::all();
        $dataTamu = IrnaGuest::all();
        $dataKamar = IrnaKamar::where('irna_status',1)->get();
        $dataTipe = IrnaTipe::all();

        foreach($dataReservasi as $dt) { 
            $Tamu      = IrnaGuest::where('id',$dt->irna_id_tamu)->first(); 
            $Kamar     = IrnaKamar::where('irna_nomor',$dt->irna_no_kamar)->first();
            $Tipe      = IrnaTipe::where('id',$dt->irna_tipe)->first();

            $dataSummary[]  = [
                'id'         => $dt->id,
                'kode'       => $dt->irna_kode,
                'nama'       => $Tamu->irna_nama,
                'identitas'  => $Tamu->irna_no_identitas,
                'telp'       => $Tamu->irna_telpon,
                'checkin'    => $dt->irna_checkin,
                'checkout'   => $dt->irna_checkout,
                'no_kamar'   => $dt->irna_no_kamar,
                'tipe'       => $dt->irna_nama,
                'total'      => $dt->irna_total,
                'status'      => $dt->irna_status,
            ];
        }
        
        $this->fpdf->AddPage('P', 'A5');
        $this->letak(public_path().'/images/logo.png');
        $this->judul('Palms Hotel','Jalan Cinta 99 No. 987', 'Siliwangi, Bandung, Jawa Barat, Indonesia, 40264');
        $this->garis();
        $this->fpdf->ln();
        $this->fpdf->ln();
        $this->fpdf->ln();
        $this->fpdf->ln();
        $this->fpdf->SetFont('Times','B','12');
        $this->fpdf->Cell(0,5,'Laporan Reservasi',0,1,'C');
        $this->fpdf->ln();
        $this->fpdf->SetFont('Arial','B',5);
        $this->fpdf->SetFillColor(161, 255, 241);
		$this->fpdf->Cell(16,6,'No Id',1,0,'C',true);
		$this->fpdf->Cell(16,6,'Nama',1,0,'C',true);
		$this->fpdf->Cell(16,6,'Kode',1,0,'C',true);
		$this->fpdf->Cell(16,6,'Check-In',1,0,'C',true);
		$this->fpdf->Cell(16,6,'Check-Out',1,0,'C',true);
		$this->fpdf->Cell(16,6,'No Kamar',1,0,'C',true);
		$this->fpdf->Cell(16,6,'Total',1,0,'C',true);
		$this->fpdf->Cell(16,6,'Status',1,0,'C',true);
        $this->fpdf->ln();
        $this->fpdf->SetFont('Arial','B',4);
        foreach($dataSummary as $dt){
            $this->fpdf->Cell(16,6,$dt['identitas'],1,0,'C',false);
            $this->fpdf->Cell(16,6,$dt['nama'],1,0,'C',false);
            $this->fpdf->Cell(16,6,$dt['kode'],1,0,'C',false);
            $this->fpdf->Cell(16,6,$dt['checkin'],1,0,'C',false);
            $this->fpdf->Cell(16,6,$dt['checkout'],1,0,'C',false);
            $this->fpdf->Cell(16,6,$dt['no_kamar'],1,0,'C',false);
            $this->fpdf->Cell(16,6,'Rp. '.number_format($dt['total']),1,0,'C',false);
            $this->fpdf->Cell(16,6,$dt['status'] == 0 ? 'Belum Bayar' : ($dt['status'] == 1 ? 'Check-In' : ($dt['status'] == 2 ? 'Check-Out' : 'Dibatalkan')),1,0,'C',false);
            $this->fpdf->ln();
        }
        
        $this->fpdf->Output('Laporan-Reservasi.pdf','I');

        exit;
    }
}
