
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
                    <div class="card-body">Data Masuk Hari Ini : <span id="total_hari_ini">0</span></div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Kamar Dipakai Hari Ini : <span id="kamar_dipakai">0</span></div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Kamar Kosong Hari Ini : <span id="kamar_kosong">0</span></div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Data Keluar Hari Ini : <span id="keluar">0</span></div>
                </div>
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
                                    <td>{{number_format( $dt['total'])}}</td>
                                </tr>
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
                    $('#total_hari_ini').html(res[0].total_hari_ini)
                    $('#kamar_dipakai').html(res[0].kamar_dipakai)
                    $('#kamar_kosong').html(res[0].kamar_kosong)
                    $('#keluar').html(res[0].keluar)
                    return;
                }
            });
    }, 1000);
</script>
@include('admin.irna_footer')
