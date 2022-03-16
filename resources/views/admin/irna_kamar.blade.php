@include('admin.irna_header')    
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Kamar</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Kamar</li>
        </ol>
        @if (ucWords(session('user')['role']) == 'Admin')
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
            <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</button>
            </div>
        </div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Kamar
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Nomor Kamar</th>
                                <th>Lantai</th>
                                <th>Tipe</th>
                                <th>Harga</th>
                                <th>Kapasitas</th>
                                <th>Status</th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataKamar as $dt)
                                <tr >
                                    <td>{{$dt->irna_nomor}}</td>
                                    <td>{{$dt->irna_lantai}}</td>
                                    @php
                                        $tipe = App\Models\IrnaTipe::where('id',$dt->irna_tipe)->first();
                                    @endphp
                                    <td>{{$tipe->irna_nama}}</td>
                                    <td>{{$dt->irna_harga}}</td>
                                    <td>{{$dt->irna_maximal}} Orang</td>
                                    <td>{{$dt->irna_status == 1 ? 'Kosong' : 'Diisi'}}</td>
                                    <td>
                                        <button  type="button" class="btn btn-info btn-sm form-modal" onclick="detailUser('{{ $dt->id }}')"><i class="fa fa-file-text fa-fw"></i></button>
                                        <button  type="button" class="btn btn-danger btn-sm form-modal" onclick="deleteUser('{{ $dt->id }}')"><i class="fa fa-trash fa-fw"></i></button>
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
                <form id="form-Kamar" method="POST" action="/kamar" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Nomor Kamar</label>
                        <div class="col-9">
                            <input type="text" name="nomor" class="form-control" id="addNomor">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Lantai Kamar</label>
                        <div class="col-9">
                            <input type="text" name="lantai" class="form-control" id="addLantai">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Tipe</label>
                        <div class="col-9">
                            <select class="form-control" name="tipe"  id="addTipe">
                                <option value="0">Silahkan Pilih Tipe</option>
                                @foreach($dataTipe as $dt)
                                    <option value="{{$dt->id}}">{{$dt->irna_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Kapasitas</label>
                        <div class="col-9">
                            <input type="text" class="form-control" name="kapasitas" id="addKapasitas">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Fasilitas</label>
                        <div class="col-9">
                            @foreach ($dataFasilitas as $dt)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fasilitas[]" value="{{$dt->id}}" id="defaultCheck{{$dt->id}}">
                                <label class="form-check-label" for="defaultCheck{{$dt->id}}">
                                  {{$dt->irna_nama}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Harga</label>
                        <div class="col-9">
                            <input type="text" class="form-control" name="harga" id="addKapasitas">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Foto</label>
                        <div class="col-9">
                            <input type="file" class="form-control" name="foto[]" id="addFoto">
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

    <!-- MODAL EDIT -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square"></i> EDIT DATA</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-Role">
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Nama Role</label>
                        <div class="col-9">
                            <input type="hidden" class="form-control" id="editId">
                            <input type="text" class="form-control" id="editNama">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Status</label>
                        <div class="col-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="editStatus" id="editStatusAktif" value="1">
                                <label class="form-check-label" for="editStatusAktif">Aktif</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="editStatus" id="editStatusNonAktif" value="2">
                                <label class="form-check-label" for="editStatusNonAktif">Non-Aktif</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="editUser()">Ubah</button>
            </div>
            </div>
        </div>
    </div>
</main>

<script>
    const addUser = () => {
        
        $(".overlay").addClass('show')
        $('#form-Kamar').submit()
    }

    
    const detailUser = (id) => {
        $(".overlay").addClass('show')
        $.ajax({
            type: 'GET',
            url: '/role/'+id,
            success: function(res) {
                
                $(".overlay").removeClass('show')
                if(res != null || res != undefined) {
                    $('#editId').val(res.id)
                    $('#editNama').val(res.irna_nama)
                    if(res.irna_status == 1) $('#editStatusAktif').prop('checked',true)
                    if(res.irna_status == 2) $('#editStatusNonAktif').prop('checked',true)
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
    }

    const editUser = () => {
        $(".overlay").addClass('show')
        
        const data = {
            _token: "{{ csrf_token() }}",
            id: $('#editId').val(),
            nama: $('#editNama').val(),
            status: $('#editStatusAktif').is(':checked') ? 1 : 2,
        }

        $.ajax({
            type: 'PUT',
            url: '/role',
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

    const deleteUser = (id) => {
        $(".overlay").addClass('show')
        
        const data = {
            _token: "{{ csrf_token() }}",
            id: id,
        }

        $.ajax({
            type: 'PUT',
            url: '/kamar',
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
