    <div class="container-fluid">
        <div class="row justify-content-center mb-2">
            <div class="col-md my-auto">
                <h1 class="h4 text-gray-800">Daftar Kerjasama</h1>
            </div>
            <!-- Card Data Mou Belum Perpanjang, Pengajuan Baru, Pengajuan Perbanjang -->
            <div class="col-md-2 text-right my-auto">
                <a href="?kerjasama&i" class="btn btn-outline-success btn-sm">
                    <i class="fas fa-plus"></i> Tambah
                </a>
                <a href="?kerjasama&a" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-archive"></i> Arsip
                </a>
            </div>
        </div>

        <!-- Data Tabel MoU -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="loader text-center"></div>
                <div id="data_kerjasama"></div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#data_kerjasama').load("_admin/view/v_mouData.php");

            $(".arsip").click(function() {
                var id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: "_admin/exc/x_v_mou_a.php?id=" + id,
                    success: function(response) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });

                        Toast.fire({
                            icon: 'success',
                            title: '<div class="text-center font-weight-bold text-uppercase">Data Berhasil Diarsipkan</b></div>'
                        });
                    },
                    error: function(response) {
                        alert(response.responseText);
                        console.log(response.responseText);
                    }
                });

                $('#data_kerjasama').load("_admin/view/v_mouData.php");
            });
        });
    </script>