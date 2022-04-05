@include('homepage.irna_header')
<!-- banner -->
<div class="banner">    	   
    <img src="/images/photos/banner.jpg"  class="img-responsive" alt="slide">
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
    <div class="embed-responsive embed-responsive-16by9 wowload fadeInLeft"><img  class="embed-responsive-item" src="/images/photos/kolam.jpg" width="50" height="50" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></img></div>
</div>
<div class="col-sm-5 col-md-4">
    <h3>History Reservasi Anda</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Kode</th>
                <th>No Kamar</th>
                <th>Check-in</th>
                <th>Check-Out</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataHistory as $dt)
            <tr>
                <th>{{$dt->irna_kode}}</th>
                <th>{{$dt->irna_no_kamar}}</th>
                <th>{{$dt->irna_checkin}}</th>
                <th>{{$dt->irna_checkout}}</th>
                <th>{{$dt->irna_status}}</th>
            </tr>
            @endforeach
        </tbody>
    </table>    
    <a href="/welcome" class="btn btn-danger">Kembali</a>
</div>
</div>  
</div>
</div>
<!-- reservation-information -->


<!-- services -->
<div class="spacer services wowload fadeInUp">
    <div class="container">
        <div class="row">
            @php
                $tipe = \App\Models\IrnaTipe::where('status',1)->get();
            @endphp
            @foreach($tipe as $dt)
            <div class="col-sm-4">
                <!-- RoomCarousel -->
                <div id="RoomCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $img = \App\Models\IrnaAttachment::where('irna_id_tipe',$dt->id)->get();
                        @endphp
                        @foreach($img as $di => $key)               
                            <div class="item  {{$di == 0 ? 'active' : 'height-full'}}"><img src="{{asset('/asset_admin/img/tipe/'.$key->irna_file)}}"  class="img-responsive" alt="slide"></div>
                        @endforeach
                    </div>
                </div>
                <!-- RoomCarousel-->
                <div class="caption"><a href="/homepage/tipe/{{$dt->irna_nama}}" class="pull-right">{{ucWords($dt->irna_nama)}}</a></div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- services -->


@include('homepage.irna_footer')

<script>
    $('#tipe').change(function()
    {
        $('#nomor').html('<option value="0">Nomor</option>');
        $('#nomor').val(0);
        $.ajax({
            type: 'GET',
            url: '/homepage/getNomor/'+this.value,
            success: function(res) {
                
                $(".overlay").removeClass('show')
                if(res != null || res != undefined) {
                    $.each(res,function(index,val) {
                        $('#nomor').append('<option value="'+val.irna_nomor+'">'+val.irna_nomor+'</option>')
                    })
                    $("#editModal").modal('show');

                    return;
                }

                alert("Terjadi kesalahan! Silahkan coba lagi", "error");

                return;
            },
            error: function(jqXHR, textStatus, error) {
                $(".overlay").removeClass('show')
                alert("Terjadi kesalahan internal! Silahkan coba lagi", "error");

                return;
            }
        });
    });

    $('#nomor').change(function()
    {
        $('#kapasitas').val('Kapasitas');
        $.ajax({
            type: 'GET',
            url: '/homepage/getKapasitas/'+this.value,
            success: function(res) {
                
                $(".overlay").removeClass('show')
                if(res != null || res != undefined) {
                    $("#kapasitas").val(res.irna_maximal+' Orang');
                    $("#editModal").modal('show');

                    return;
                }

                alert("Terjadi kesalahan! Silahkan coba lagi", "error");

                return;
            },
            error: function(jqXHR, textStatus, error) {
                $(".overlay").removeClass('show')
                alert("Terjadi kesalahan internal! Silahkan coba lagi", "error");

                return;
            }
        });
    });

    $('#checkin').on('change',function(){
        let checkin = new Date(this.value)
        let checkout = new Date($('#checkout').val())
        var oneDay  = 24*60*60*1000
        var diffDays = Math.abs((checkin.getTime() - checkout.getTime()) / oneDay)
        var nomor = $('#nomor').val()
        
        $.ajax({
            type: 'GET',
            url: '/homepage/getHarga/'+nomor,
            success: function(res) {
                
                $(".overlay").removeClass('show')
                if(res != null || res != undefined) {
                    let harga = res.irna_harga
                    harga = harga*diffDays
                    $('#total').val('Rp. '+harga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
                    $('#totalFix').val(harga);

                    $("#editModal").modal('show');

                    return;
                }

                alert("Terjadi kesalahan! Silahkan coba lagi", "error");

                return;
            },
            error: function(jqXHR, textStatus, error) {
                $(".overlay").removeClass('show')
                alert("Terjadi kesalahan internal! Silahkan coba lagi", "error");

                return;
            }
        });
    });
    
</script>