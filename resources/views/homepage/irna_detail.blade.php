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
        <h3>{{ucWords($getData->irna_nama)}}</h3>
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
                        <td>Tipe Kamar</td>
                        <td><b>:</b></td>
                        <td>{{$getData->irna_nama}}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Kamar Tersedia</td>
                        <td><b>:</b></td>
                        <td>{{count($getDataKamar)}}</td>
                    </tr>
                    <tr>
                        <td>Nomor Kamar Tersedia</td>
                        <td><b>:</b></td>
                        @php
                            foreach ($getDataKamar as $dt => $key) {
                                $kamar[] = $key->irna_nomor;
                            }
                        @endphp
                        <td>{{isset($kamar) ? implode(' , ',$kamar) : '-'}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>  
</div>
</div>
<!-- reservation-information -->


<!-- services -->
<div class="spacer services wowload fadeInUp">
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
</div>
<!-- services -->


@include('homepage.irna_footer')

<script>

    $('#jumlah_tamu').on('input',function(){
        if(parseInt(this.value) > parseInt($('#kapasitas').val())) {
            $('#submit-reserv').prop('disabled',true)
        } else {
            $('#submit-reserv').prop('disabled',false)
        }
    })

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
        $('#kapasitas').val('Maksimal');
        $.ajax({
            type: 'GET',
            url: '/homepage/getKapasitas/'+this.value,
            success: function(res) {
                
                $(".overlay").removeClass('show')
                if(res != null || res != undefined) {
                    $("#kapasitas").val(res.irna_maximal);
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