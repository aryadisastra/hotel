<!DOCTYPE html>
<html>
<head>
    <title>STRUK RESERVASI PALMS HOTEL</title>
</head>
<body class="sb-nav-fixed">
    <h1 align="center">{{ $title }}</h1>
  
<h3 align="center" style="color: #000;">Jalan Cinta 99 No. 987</h3>
<h3 align="center" style="color: #000;">Siliwangi, Bandung, Jawa Barat, Indonesia, 40264</h3>
    <table border="1"  align="center" celspacing="5" celspadding="5" style="width:100%;">
        <tr>
            <td>No ID</td>
            <td>kode</td>
            <td>Check-In</td>
            <td>Check-Out</td>
            <td>No Kamar</td>
            <td>Jumlah Tamu</td>
            <td>Total</td>
        </tr>
        <tr>
            <td>{{$NoID}}</td>
            
            <td>{{$kode}}</td>
            
            <td>{{$checkin}}</td>
            
            <td>{{$checkout}}</td>
            
            <td>{{$no_kamar}}</td>

            <td>{{$jumlah_tamu}}</td>
            
            <td>{{"Rp. "number_format($total)}}</td>
        </tr>
    </table>

    <h4 class="m-0 font-weight-bold text-primary" align="right">Bandung, <?php echo date('d - m - Y'); ?></h4> 
                            <h4 class="m-0 font-weight-bold text-primary" align="right">Tamu,</h4>
    
</body>
</html>