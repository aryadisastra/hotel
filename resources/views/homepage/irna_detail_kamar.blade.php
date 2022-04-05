@include('homepage.irna_header')
<!-- banner -->
<div class="banner">    	   
    <img src="{{asset('images/photos/banner.jpg')}}"  class="img-responsive" alt="slide">
    <div class="welcome-message">
        <div class="wrap-info">
            <div class="information" style="opacity: 0.6">
                <h1  class="animated fadeInDown">Hotel Terbaik Di Bandung</h1>
                <p class="animated fadeInUp" style="background-color : black ">Hotel Ter-Mewah Di Jawa Barat Dengan Kualitas Yang Bagus Dan Pelayanan Yang Baik</p>                
            </div>
            <a href="#information" class="arrow-nav scroll wowload fadeInDownBig"><i class="fa fa-angle-down"></i></a>
        </div>
    </div>
</div>
<!-- banner-->


<!-- reservation-information -->
<div id="information" class="spacer reserve-info ">
<div class="container">
<div class="row">
<div class="col-sm-7 col-md-8">
    <div class="embed-responsive embed-responsive-16by9 wowload fadeInLeft">
        <h3>{{ucWords('Kamar Nomor '.$getDataKamar->irna_nomor)}}</h3>
        <div class="col-sm-7">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <td>Keterangan</td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nomor Kamar</td>
                        <td><b>:</b></td>
                        <td>{{$getDataKamar->irna_nomor}}</td>
                    </tr>
                    <tr>
                        <td>Lantai Kamar</td>
                        <td><b>:</b></td>
                        <td>{{$getDataKamar->irna_lantai}}</td>
                    </tr>
                    <tr>
                        <td>Kapasitas</td>
                        <td><b>:</b></td>
                        <td>{{$getDataKamar->irna_maximal." Orang"}}</td>
                    </tr>
                    <tr>
                        <td>Harga Per-Malam</td>
                        <td><b>:</b></td>
                        <td>{{"Rp. ".number_format($getDataKamar->irna_harga)}}</td>
                    </tr>
                    <tr>
                        <td>Fasilitas</td>
                        <td><b>:</b></td>
                        @php
                            $fasilitas = explode(',',$getDataKamar->irna_fasilitas);
                            foreach ($fasilitas as $dt) {
                                $fas = \App\Models\IrnaFasilitas::where('id',$dt)->first();
                                $namaFas[] = $fas->irna_nama; 
                            }
                        @endphp
                        <td>{{implode(' , ',$namaFas)}}</td>
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td><b>:</b></td>
                        <td><a href="{{asset('asset_admin/img/kamar/'.$getDataKamar->irna_foto)}}"><img style="width: 100px" class="img-responsive" src="{{asset('asset_admin/img/kamar/'.$getDataKamar->irna_foto)}}" alt=""></a></td>
                    </tr>
                </tbody>
            </table>
            <a href="javascript:history.go(-1)" class="btn btn-danger">Kembali</a>
            <a href="/homepage/reservasi/{{$getDataKamar->id}}" class="btn btn-info">Reservasi</a>
        </div>
    </div>
</div>
</div>  
</div>
</div>
<!-- reservation-information -->


<!-- services -->
{{-- <div class="spacer services wowload fadeInUp">
<div class="container">
    <div class="row">
        @foreach($getDataKamar as $dt)
        <div class="col-sm-4">
            <!-- RoomCarousel -->
            <div id="RoomCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">             
                    <div class="item  active"><img src="{{asset('/asset_admin/img/kamar/'.$dt->irna_foto)}}"  class="img-responsive" alt="slide"></div>
                </div>
            </div>
            <!-- RoomCarousel-->
            <div class="caption"><a href="/homepage/kamar/{{$dt->id}}" class="pull-right">{{ucWords('Kamar Nomor '.$dt->irna_nomor)}}</a></div>
        </div>
        @endforeach
    </div>
</div>
</div> --}}
<!-- services -->


@include('homepage.irna_footer')