
@include('admin.irna_header')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Data Masuk Hari Ini : <span id="total">0</span></div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Kamar Dipakai Hari Ini : <span id="menunggu">0</span></div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Kamar Kosong Hari Ini : <span id="selesai">0</span></div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Data Keluar Hari Ini : <span id="belum">0</span></div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Reservasi
            </div>
            <div class="card-body">
                <div class="table-responsive table table-striped table-hover">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Pemesan</th>
                                <th>Kode Reservasi</th>
                                <th>Metode Reservasi</th>
                                <th>Tipe - Nomor Kamar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fetch as $dt)
                            {{-- <tr style="background-color:{{$dt['status_angka'] == 3 ? '#74f779' : ($dt['status_angka'] == 1 ? '#fc8d8d' : '#fffc69')}}">
                                <td>{{$dt['pasien']}}</td>
                                <td>{{$dt['umur']}}</td>
                                <td>{{$dt['gender']}}</td>
                                <td>{{$dt['hasil']}}</td>
                                <td>{{$dt['status']}}</td>
                                <td>{{$dt['perawat']}}</td>
                                <td>{{$dt['tlm']}}</td>
                                <td>{{$dt['dokter']}}</td>
                            </tr> --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    history.replaceState({}, null, "/dashboard");
    setInterval(() => {
        $.ajax({
                type: 'GET',
                url: '/dashboard/getData',
                success: function(res) {
                    $('#total').html(res[0].total)
                    $('#menunggu').html(res[0].menunggu)
                    $('#selesai').html(res[0].selesai)
                    $('#belum').html(res[0].belum)
                    return;
                }
            });
    }, 1000);
</script>
@include('admin.irna_footer')
