@include('admin.irna_header')    
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Tamu</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Tamu</li>
        </ol>
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
            <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</button>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Tamu
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No ID</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Telp</th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataUser as $dt)
                                <tr >
                                    <td>{{$dt->irna_no_identitas}}</td>
                                    <td>{{ucWords($dt->irna_nama)}}</td>
                                    <td>{{$dt->irna_username}}</td>
                                    <td>{{$dt->irna_email}}</td>
                                    <td>{{$dt->irna_telpon}}</td>
                                    <td>
                                        <button  type="button" class="btn btn-info btn-sm form-modal" onclick="detailUser('{{ $dt->id }}')"><i class="fa fa-file-text fa-fw"></i></button>
                                        @if (ucWords($dt->irna_username) != ucWords(session('user')['username']))
                                        <button  type="button" class="btn btn-danger btn-sm form-modal" onclick="deleteUser('{{ $dt->id }}')"><i class="fa fa-trash fa-fw"></i></button>
                                        @endif
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
                        <label class="col-3 col-form-label">No ID</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="addNoId">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Nama</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="addNama">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Email</label>
                        <div class="col-9">
                            <input type="email" class="form-control" id="addEmail">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Username</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="addUsername">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Password</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="addPassword">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">No Telp</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="addTelp">
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
                <form id="form-Pengguna">
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">No ID</label>
                        <div class="col-9">
                            <input type="hidden" class="form-control" id="editId">
                            <input type="text" class="form-control" id="editNoId">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Nama</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="editNama">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Email</label>
                        <div class="col-9">
                            <input type="email" class="form-control" id="editEmail">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Username</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="editUsername">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">Password</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="editPassword" placeholder="*Kosongkan Jika Tidak Diubah">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-3 col-form-label">No Telp</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="editTelp">
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
        const data = {
            _token: "{{ csrf_token() }}",
            nama: $('#addNama').val(),
            username: $('#addUsername').val(),
            password: $('#addPassword').val(),
            email: $('#addEmail').val(),
            telpon: $('#addTelp').val(),
            no_id: $('#addNoId').val(),
        }
               
        $.ajax({
            type: 'POST',
            url: '/data-tamu',
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

    
    const detailUser = (id) => {
        $(".overlay").addClass('show')
        $.ajax({
            type: 'GET',
            url: '/data-tamu/'+id,
            success: function(res) {
                
                $(".overlay").removeClass('show')
                if(res != null || res != undefined) {
                    $('#editId').val(res.id),
                    $('#editNama').val(res.irna_nama),
                    $('#editUsername').val(res.irna_username),
                    $('#editEmail').val(res.irna_email),
                    $('#editTelp').val(res.irna_telpon),
                    $('#editNoId').val(res.irna_no_identitas),
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
            username: $('#editUsername').val(),
            password: $('#editPassword').val(),
            email: $('#editEmail').val(),
            telpon: $('#editTelp').val(),
            no_id: $('#editNoId').val(),
        }

        $.ajax({
            type: 'POST',
            url: '/data-tamu/edit',
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
            url: '/data-tamu',
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
