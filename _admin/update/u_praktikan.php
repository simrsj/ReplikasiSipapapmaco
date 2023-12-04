<?php

if (is_numeric($_GET['u'])) {
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="h3 mb-2 text-gray-800">Data Praktikan</h1>
            </div>
            <div class="col-lg-2 my-auto text-right">
                <button class="btn btn-outline-success btn-sm tambah_init">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
        </div>
        <div class="card shadow mb-4 card-body" id="data_tambah_praktikan" style="display: none;">
            <form method="post" class="form-data" id="form_tambah_praktikan">
                <h5 class="mb-2 text-gray-800">Tambah Praktikan</h5>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md">
                            <input type="hidden" name="t_id_praktik" id="t_id_praktik" value="<?= $_GET['u']; ?>">
                            NAMA : <span class="text-danger">*</span><br>
                            <input class="form-control" name="t_nama_praktikan" id="t_nama_praktikan" required>
                            <span class="text-danger font-weight-bold  font-italic text-xs blink" id="err_nama"></span>
                        </div>
                        <div class="col-md">
                            NIM / NPM / NIS : <span class="text-danger">*</span><br>
                            <input class="form-control" name="t_no_id_praktikan" id="t_no_id_praktikan" required>
                            <span class="text-danger font-weight-bold  font-italic text-xs blink" id="err_no_id"></span>
                        </div>
                        <div class="col-md">
                            No. HP : <span class="text-danger">*</span><br>
                            <input class="form-control" name="t_telp_praktikan" id="t_telp_praktikan" required>
                            <span class="text-danger font-weight-bold  font-italic text-xs blink" id="err_no_hp"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md">
                            No. WA : <span class="text-danger">*</span><br>
                            <input class="form-control" name="t_wa_praktikan" id="t_wa_praktikan" required>
                            <span class="text-danger font-weight-bold  font-italic text-xs blink" id="err_no_wa"></span>
                        </div>
                        <div class="col-md">
                            EMAIL : <span class="text-danger">*</span><br>
                            <input class="form-control" name="t_email_praktikan" id="t_email_praktikan" required>
                            <span class="text-danger font-weight-bold  font-italic text-xs blink" id="err_email"></span>
                        </div>
                        <div class="col-md">
                            ASAL KOTA / KABUPATEN : <span class="text-danger">*</span><br>
                            <input class="form-control" name="t_kota_kab_praktikan" id="t_kota_kab_praktikan" required>
                            <span class="text-danger font-weight-bold  font-italic text-xs blink" id="err_asal"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" name="tambah" class="btn btn-success tambah">
                        Tambah
                    </button>
                    <button type="button" class="btn btn-outline-danger tambah_tutup">
                        Tutup
                    </button>
                </div>
            </form>
        </div>

        <div class="card shadow mb-4 card-body" id="data_ubah_praktikan" style="display: none;">
            <form method="post" class="form-data" id="form_ubah_praktikan">
                <h5 class="mb-2 text-gray-800">Ubah Praktikan</h5>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md">
                            <input type="hidden" name="id_praktikan" id="id_praktikan">
                            NAMA : <span class="text-danger">*</span><br>
                            <input class="form-control" name="nama_praktikan" id="nama_praktikan" required>
                            <span class="text-danger font-weight-bold  font-italic text-xs blink" id="err_nama"></span>
                        </div>
                        <div class="col-md">
                            NIM / NPM / NIS : <span class="text-danger">*</span><br>
                            <input class="form-control" name="no_id_praktikan" id="no_id_praktikan" required>
                            <span class="text-danger font-weight-bold  font-italic text-xs blink" id="err_no_id"></span>
                        </div>
                        <div class="col-md">
                            No. HP : <span class="text-danger">*</span><br>
                            <input class="form-control" name="telp_praktikan" id="telp_praktikan" required>
                            <span class="text-danger font-weight-bold  font-italic text-xs blink" id="err_no_hp"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md">
                            No. WA : <span class="text-danger">*</span><br>
                            <input class="form-control" name="wa_praktikan" id="wa_praktikan" required>
                            <span class="text-danger font-weight-bold  font-italic text-xs blink" id="err_no_wa"></span>
                        </div>
                        <div class="col-md">
                            EMAIL : <span class="text-danger">*</span><br>
                            <input class="form-control" name="email_praktikan" id="email_praktikan" required>
                            <span class="text-danger font-weight-bold  font-italic text-xs blink" id="err_email"></span>
                        </div>
                        <div class="col-md">
                            ASAL KOTA / KABUPATEN : <span class="text-danger">*</span><br>
                            <input class="form-control" name="kota_kab_praktikan" id="kota_kab_praktikan" required>
                            <span class="text-danger font-weight-bold  font-italic text-xs blink" id="err_asal"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" name="ubah" class="btn btn-primary ubah">
                        Ubah
                    </button>
                    <button type="button" class="btn btn-outline-danger ubah_tutup">
                        Tutup
                    </button>
                </div>
            </form>
        </div>

        <div class="card shadow mb-4 card-body" id="data_praktikan"></div>
    </div>
    <script>
        $(document).ready(function() {
            $('#data_praktikan').load('_admin/update/u_praktikanData.php?u=<?= $_GET['u']; ?>');
        });

        $(".tambah_init").click(function() {
            document.getElementById("err_nama").innerHTML = "";
            document.getElementById("err_no_id").innerHTML = "";
            document.getElementById("err_no_hp").innerHTML = "";
            document.getElementById("err_no_wa").innerHTML = "";
            document.getElementById("err_email").innerHTML = "";
            document.getElementById("err_asal").innerHTML = "";
            document.getElementById("form_tambah_praktikan").reset();
            $("#data_tambah_praktikan").fadeIn('slow');
            $("#data_ubah_praktikan").fadeOut('fast');
        });

        $(".tambah_tutup").click(function() {
            document.getElementById("err_nama").innerHTML = "";
            document.getElementById("err_no_id").innerHTML = "";
            document.getElementById("err_no_hp").innerHTML = "";
            document.getElementById("err_no_wa").innerHTML = "";
            document.getElementById("err_email").innerHTML = "";
            document.getElementById("err_asal").innerHTML = "";
            document.getElementById("form_tambah_praktikan").reset();
            $("#data_tambah_praktikan").fadeOut('slow');
        });

        $(document).on('click', '.tambah', function() {
            var data = $('#form_tambah_praktikan').serialize();
            var nama_praktikan = document.getElementById("t_nama_praktikan").value;
            var no_id_praktikan = document.getElementById("t_no_id_praktikan").value;
            var telp_praktikan = document.getElementById("t_telp_praktikan").value;
            var wa_praktikan = document.getElementById("t_wa_praktikan").value;
            var email_praktikan = document.getElementById("t_email_praktikan").value;
            var kota_kab_praktikan = document.getElementById("t_kota_kab_praktikan").value;

            //cek data from ubah bila tidak diiisi
            if (
                nama_praktikan == "" ||
                no_id_praktikan == "" ||
                telp_praktikan == "" ||
                wa_praktikan == "" ||
                email_praktikan == "" ||
                kota_kab_praktikan == ""
            ) {
                if (nama_praktikan == "") {
                    document.getElementById("err_nama").innerHTML = "Nama Harus Diisi";
                } else {
                    document.getElementById("err_nama").innerHTML = "";
                }

                if (no_id_praktikan == "") {
                    document.getElementById("err_no_id").innerHTML = "NIM / NPM / NIS Harus Diisi";
                } else {
                    document.getElementById("err_no_id").innerHTML = "";
                }

                if (telp_praktikan == "") {
                    document.getElementById("err_no_hp").innerHTML = "No. Telp Harus Diisi";
                } else {
                    document.getElementById("err_no_hp").innerHTML = "";
                }

                if (wa_praktikan == "") {
                    document.getElementById("err_no_wa").innerHTML = "No. WA Harus Diisi";
                } else {
                    document.getElementById("err_no_wa").innerHTML = "";
                }

                if (email_praktikan == "") {
                    document.getElementById("err_email").innerHTML = "Email Harus Diisi";
                } else {
                    document.getElementById("err_email").innerHTML = "";
                }

                if (kota_kab_praktikan == "") {
                    document.getElementById("err_asal").innerHTML = "Kota/Kabupaten Harus Diisi";
                } else {
                    document.getElementById("err_asal").innerHTML = "";
                }

            } else {
                $.ajax({
                    type: 'POST',
                    url: "_admin/exc/x_u_praktikan_s.php",
                    data: data,
                    success: function() {

                        document.getElementById("form_tambah_praktikan").reset();
                        $('#data_praktikan').load('_admin/update/u_praktikanData.php?u=<?= $_GET['u']; ?>');

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
                            title: '<div class="text-center font-weight-bold text-uppercase">Data Berhasil Diubah</b></div>'
                        });
                        document.getElementById("err_nama").innerHTML = "";
                        document.getElementById("err_no_id").innerHTML = "";
                        document.getElementById("err_no_hp").innerHTML = "";
                        document.getElementById("err_no_wa").innerHTML = "";
                        document.getElementById("err_email").innerHTML = "";
                        document.getElementById("err_asal").innerHTML = "";
                    },
                    error: function(response) {
                        console.log(response.responseText);
                    }
                });
            }
        });
    </script>
<?php
} else {
    include "_error/index.php";
}
?>