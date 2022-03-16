

<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Palms Hotel 2022</div>
        </div>
    </div>
</footer>
</div>
</div>
</body>
<script src="{{asset('asset_admin/source_offline/bootstrap.min.js')}}"></script>
<script src="{{asset('asset_admin/source_offline/bootstrap-tagsinput.min.js')}}"></script>
<script>
    $(".overlay").addClass('show')
    function load() {
        $(".overlay").removeClass('show')
    }
    setInterval(load, 3000)
    $(document).ready(function() {
        $('#datatablesSimple').DataTable({
            responsive : true,
            "ordering" : false,
            "language": {
                "decimal":        "",
                "emptyTable":     "Data Tidak Ada Pada Tabel Ini",
                "info":           "Menampilkan Halaman _START_ Dari _END_, Total _TOTAL_ Data",
                "infoEmpty":      "Menampilkan Halaman 0 Dari 0, Total 0 Data",
                "infoFiltered":   "(Hasil Filter Dari _MAX_ Total Data)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Menampilkan _MENU_ Data",
                "loadingRecords": "Tunggu Sebentar...",
                "processing":     "Sedang Memproses...",
                "search":         "Cari :",
                "zeroRecords":    "Data Tidak Ditemukan",
                "paginate": {
                    "first":      "Pertama",
                    "last":       "Terakhir",
                    "next":       "Selanjutnya",
                    "previous":   "Sebelumnya"
                },
                "aria": {
                    "sortAscending":  ": Pengurutan Dari Nilai Terendah",
                    "sortDescending": ": Pengurutan Dari Nilai Terendah"
                }
            }
        });
    } );

    function ucWords (str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}
</script>
</html>
