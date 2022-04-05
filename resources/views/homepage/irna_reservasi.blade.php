@include('homepage.irna_header')
{{isset($action) ? $action : $action = ''}}
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
    <div class="embed-responsive embed-responsive-16by9 wowload fadeInLeft"><img  class="embed-responsive-item" src="{{asset('asset_admin/img/kamar/'.$data->irna_foto)}}" width="50" height="50" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></img></div>
</div>
<div class="col-sm-5 col-md-4">
    <h3>Pemesanan Kamar No {{$data->irna_nomor}}</h3>
    <form role="form" action="/homepage/reservasi-kamar" method="POST" class="wowload fadeInRight">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" value="{{session('guest')['nama']}}" readonly>
        </div>
        <div class="form-group">
            <input type="email" class="form-control"  value="{{session('guest')['email']}}" readonly>
        </div>
        <div class="form-group">
            <input type="Phone" class="form-control"  value="{{session('guest')['telpon']}}" readonly>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-4">
                    <label for="tipe">Tipe : </label>
                    <select class="form-control col-sm-2" name="tipe" id="tipe" disabled>
                        <option>Tipe</option>
                        @foreach ($tipe as $dt)
                        <option value="{{$dt->id}}" {{$data->irna_tipe == $dt->id ? 'selected' : ''}}>{{$dt->irna_nama}}</option>  
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-4">
                    <label for="nomor">Nomor : </label>
                    <input type="text" class="form-control" name="nomor" value="{{$data->irna_nomor}}" id="nomor" readonly>
                </div>
                <div class="col-xs-4">
                    <label for="kapasitas">Maksimal : </label>
                    <input type="text" class="form-control" name="" id="kapasitas"  value="{{$data->irna_maximal.' Orang'}}" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="jumlah_tamu">Jumlah Orang</label>
            <input type="number" class="form-control"  value="" name="jumlah_tamu" id="jumlah_tamu">
        </div>
        <div class="form-group">
            <label for="checkin">Tanggal Check-in : </label>
            <input type="datetime-local" class="form-control" id="checkin"  name="checkin" placeholder="Check-in Dari">
        </div>
        <div class="form-group">
            <label for="checkin">Tanggal Check-out : </label>
            <input type="datetime-local" class="form-control"  name="checkout"  id="checkout" placeholder="Check-in Dari">
        </div>
        <div class="form-group">
            <label for="checkin">Total Harga : </label>
            <input type="hidden" class="form-control" id="totalFix"  name="total" readonly>
            <input type="text" class="form-control" id="total"  name="totalbak" readonly>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="pesan"  placeholder="Message" rows="4"></textarea>
        </div>
    <button class="btn btn-default" id="submit-reserv">Submit</button>
    </form>    
</div>
</div>  
</div>
</div>
<!-- reservation-information -->


<!-- services -->
{{-- <div class="spacer services wowload fadeInUp">
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
</div> --}}
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