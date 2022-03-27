@include('admin.irna_header')    
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Reservasi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Reservasi</li>
        </ol>
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
            <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</button>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Reservasi
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No ID</th>
                                <th>Nama</th>
                                <th>Kode</th>
                                <th>Check-In</th>
                                <th>Check-Out</th>
                                <th>No Kamar</th>
                                <th>Total</th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataSummary as $dt)
                                <tr >
                                    <td>{{$dt['identitas']}}</td>
                                    <td>{{ucWords($dt['nama'])}}</td>
                                    <td>{{$dt['kode']}}</td>
                                    <td>{{$dt['checkin']}}</td>
                                    <td>{{$dt['checkout']}}</td>
                                    <td>{{$dt['no_kamar']}}</td>
                                    <td>{{$dt['total']}}</td>
                                    <td>
                                        <button  type="button" class="btn btn-danger btn-sm form-modal" onclick="deleteUser('{{ $dt['id'] }}')"><i class="fa fa-trash fa-fw"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> TAMBAH DATA</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-Pengguna">
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Tamu</label>
                        <div class="col-9">
                            <select id="addTamu" class="form-control">
                                <option value="0">Pilih Tamu</option>
                                @foreach($dataTamu as $dt)
                                <option value="{{$dt->id}}">{{$dt->irna_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Tipe</label>
                        <div class="col-9">
                            <select id="addTipe" class="form-control">
                                <option value="0">Pilih Tipe</option>
                                @foreach($dataTipe as $dt)
                                <option value="{{$dt->id}}">{{$dt->irna_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Nomor Kamar</label>
                        <div class="col-9">
                            <select id="addNomor" class="form-control">
                                <option value="0">Pilih Nomor</option>  
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Kapasitas</label>
                        <div class="col-9">
                            <input type="text" id="addKapasitas" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Check-In</label>
                        <div class="col-9">
                            <input type="datetime-local" id="addCheckin" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Check-Out</label>
                        <div class="col-9">
                            <input type="datetime-local" id="addCheckout" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Total</label>
                        <div class="col-9">
                            <input type="hidden" id="totalFix" class="form-control" readonly>
                            <input type="text" id="addTotal" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Pesan</label>
                        <div class="col-9">
                            <input type="text" id="addPesan" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="addUser()">Simpan</button>
            </div>
            </div>
        </div>
    </div>

</main>

<script>

    $('#addTipe').change(function() {
        $('#addNomor').html('<option value="0">Nomor</option>');
        $('#addNomor').val(0);
        $.ajax({
            type: 'GET',
            url: '/homepage/getNomor/'+this.value,
            success: function(res) {
                
                $(".overlay").removeClass('show')
                if(res != null || res != undefined) {
                    $.each(res,function(index,val) {
                        $('#addNomor').append('<option value="'+val.irna_nomor+'">'+val.irna_nomor+'</option>')
                    })

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
    })

    $('#addNomor').change(function()
    {
        $('#addKapasitas').val('Kapasitas');
        $.ajax({
            type: 'GET',
            url: '/homepage/getKapasitas/'+this.value,
            success: function(res) {
                
                $(".overlay").removeClass('show')
                if(res != null || res != undefined) {
                    $("#addKapasitas").val(res.irna_maximal+' Orang');

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

    $('#addCheckin').on('change',function(){
        let checkin = new Date(this.value)
        let checkout = new Date($('#addCheckout').val())
        var oneDay  = 24*60*60*1000
        var diffDays = Math.abs((checkin.getTime() - checkout.getTime()) / oneDay)
        var nomor = $('#addNomor').val()
        
        $.ajax({
            type: 'GET',
            url: '/homepage/getHarga/'+nomor,
            success: function(res) {
                
                $(".overlay").removeClass('show')
                if(res != null || res != undefined) {
                    let harga = res.irna_harga
                    harga = harga*diffDays
                    $('#addTotal').val('Rp. '+harga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
                    $('#totalFix').val(harga);

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
    $('#addCheckout').on('change',function(){
        let checkout = new Date(this.value)
        let checkin = new Date($('#addCheckin').val())
        var oneDay  = 24*60*60*1000
        var diffDays = Math.abs((checkout.getTime() - checkin.getTime()) / oneDay)
        var nomor = $('#addNomor').val()
        
        $.ajax({
            type: 'GET',
            url: '/homepage/getHarga/'+nomor,
            success: function(res) {
                
                $(".overlay").removeClass('show')
                if(res != null || res != undefined) {
                    let harga = res.irna_harga
                    harga = harga*diffDays
                    $('#addTotal').val('Rp. '+harga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
                    $('#totalFix').val(harga);

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
    const addUser = () => {
        
        $(".overlay").addClass('show')
        const data = {
            _token: "{{ csrf_token() }}",
            id_tamu :$('#addTamu').val(),
            checkin :$('#addCheckin').val(),
            checkout : $('#addCheckout').val(),
            pesan   : $('#addPesan').val(),
            nomor   :$('#addNomor').val(),
            total   :$('#totalFix').val(),
        }
               
        $.ajax({
            type: 'POST',
            url: '/data-reservasi',
            data: data,
            success: function(res) {
                if(res == true) {
                    $(".overlay").removeClass('show')
                    location.reload();

                    return;
                }

                alert("Terjadi kesalahan! Silahkan coba lagi", "error");

                return;
            },
            error: function(jqXHR, textStatus, error) {
                $(".overlay").removeClass('show');

                alert("Data kurang lengkap! Silahkan coba lagi", "error");

                return;
            }
        })
    }

    const deleteUser = (id) => {
        $(".overlay").addClass('show')
        
        const data = {
            _token: "{{ csrf_token() }}",
            id: id,
        }

        $.ajax({
            type: 'PUT',
            url: '/data-reservasi',
            data: data,
            success: (res) => {
                $(".overlay").removeClass('show')

                if(res == true) {
                    location.reload()

                    return
                }
                
                alert("Terjadi kesalahan internal! Silahkan coba lagi", "error")

                return
            },
            error: (jqXHR, textStatus, error) => {
                $(".overlay").removeClass('show')

                alert("Terjadi kesalahan indternal! Silahkan coba lagi", "error")

                return
            }
        })
    }
</script>
@include('admin.irna_footer')