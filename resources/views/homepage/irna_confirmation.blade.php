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
    <h3>Selamat Datang, {{ucWords(session('guest')['nama'])}}</h3>
    <a class="btn btn-info" href="/history">History Reservasi</a>    
    <a class="btn btn-success" href="/reservasi">Reservasi</a>    
</div>
</div>  
</div>
</div>
<!-- reservation-information -->


<!-- services -->
<div class="spacer services wowload fadeInUp">
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <!-- RoomCarousel -->
            <div id="RoomCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <div class="item active"><img src="/images/photos/8.jpg" class="img-responsive" alt="slide"></div>                
                <div class="item  height-full"><img src="/images/photos/9.jpg"  class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="/images/photos/10.jpg"  class="img-responsive" alt="slide"></div>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#RoomCarousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="right carousel-control" href="#RoomCarousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
            </div>
            <!-- RoomCarousel-->
            <div class="caption">Rooms<a href="rooms-tariff.php" class="pull-right"><i class="fa fa-edit"></i></a></div>
        </div>


        <div class="col-sm-4">
            <!-- RoomCarousel -->
            <div id="TourCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <div class="item active"><img src="/images/photos/6.jpg" class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="/images/photos/3.jpg"  class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="/images/photos/4.jpg"  class="img-responsive" alt="slide"></div>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#TourCarousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="right carousel-control" href="#TourCarousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
            </div>
            <!-- RoomCarousel-->
            <div class="caption">Tour Packages<a href="gallery.php" class="pull-right"><i class="fa fa-edit"></i></a></div>
        </div>


        <div class="col-sm-4">
            <!-- RoomCarousel -->
            <div id="FoodCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <div class="item active"><img src="/images/photos/1.jpg" class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="/images/photos/2.jpg"  class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="/images/photos/5.jpg"  class="img-responsive" alt="slide"></div>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#FoodCarousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="right carousel-control" href="#FoodCarousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
            </div>
            <!-- RoomCarousel-->
            <div class="caption">Food and Drinks<a href="gallery.php" class="pull-right"><i class="fa fa-edit"></i></a></div>
        </div>
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