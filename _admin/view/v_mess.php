<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <h1 class="h3 mb-2 text-gray-800">Daftar Mess/Pemondokan</h1>
        </div>
        <div class="col-md-2 text-right">
            <a class='btn btn-outline-success btn-sm tambah_init'>
                <i class="fas fa-plus"></i> Tambah
            </a>
        </div>
    </div>

    <!-- form tambah mess  -->
    <div class="card shadow mb-4 card-body text-xs" id="data_tambah_mess" style="display: none;">
        <form class="form-data" method="post" id="form_tambah_mess">
            <!-- Nama Institusi, MoU RSJ dan Institusi -->
            <div class="row mb-4">
                <div class="col-md">
                    Nama Mess/Pemondokan : <span class="text-danger">*</span>&nbsp;&nbsp;
                    <input class="form-control form-control-sm" name="t_nama_mess" id="t_nama_mess" required>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_nama_mess"></div>
                </div>
                <div class="col-md">
                    Nama Pemilik : <span class="text-danger">*</span>&nbsp;&nbsp;
                    <input class="form-control form-control-sm" name="t_nama_pemilik_mess" id="t_nama_pemilik_mess" required>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_nama_pemilik_mess"></div>
                </div>
                <div class="col-md">
                    Telp. Pemilik : <span class="text-danger">*</span>&nbsp;&nbsp;
                    <input class="form-control form-control-sm" type="number" name="t_telp_pemilik_mess" id="t_telp_pemilik_mess" required>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_telp_pemilik_mess"></div>
                </div>
                <div class="col-md">
                    E-Mail Pemilik : &nbsp;&nbsp;
                    <input class="form-control form-control-sm" type="email" name="t_email_pemilik_mess" id="t_email_pemilik_mess">
                    <!-- <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_email_pemilik_mess"></div> -->
                </div>
                <div class="col-md-2">
                    Kepemilikan : <span class="text-danger">*</span>&nbsp;&nbsp;
                    <select class="select2" name="t_kepemilikan_mess" id="t_kepemilikan_mess" required>
                        <option value=""></option>
                        <option value="dalam">Dalam (RSJ)</option>
                        <option value="luar">Luar</option>
                    </select>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_kepemilikan_mess"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    Tarif Tanpa Makan : (Rp)<span style="color:red">*</span><br>
                    <input type="number" class="form-control form-control-sm" name="t_tarif_tanpa_makan_mess" id="t_tarif_tanpa_makan_mess" required>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_tarif_tanpa_makan_mess"></div>
                </div>
                <div class="col-md-2">
                    Tarif Dengan Makan : (Rp)<span style="color:red">*</span><br>
                    <input type="number" class="form-control form-control-sm" name="t_tarif_dengan_makan_mess" id="t_tarif_dengan_makan_mess" required>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_tarif_dengan_makan_mess"></div>
                </div>
                <div class="col-md-2">
                    Kapasitas Total : <span style="color:red">*</span><br>
                    <input type="number" class="form-control form-control-sm" name="t_kapsitas_total_mess" id="t_kapsitas_total_mess" required>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_kapsitas_total_mess"></div>
                </div>
                <div class="col-md">
                    Alamat : <span style="color:red">*</span><br>
                    <textarea class="form-control form-control-sm" name="t_alamat_mess" id="t_alamat_mess" required></textarea>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_alamat_mess"></div>
                </div>
                <div class="col-md">
                    Fasilitas : <span style="color:red">*</span><br>
                    <textarea class="form-control form-control-sm" name="t_fasilitas_mess" id="t_fasilitas_mess" required></textarea>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_fasilitas_mess"></div>
                </div>
            </div>
            <hr>
            <div class="form-inline navbar nav-link justify-content-end">
                <button type="button" name="tambah" class="btn btn-success btn-sm tambah">
                    Tambah
                </button>
                &nbsp;&nbsp;
                <button type="button" class="btn btn-outline-danger btn-sm tambah_tutup">
                    Tutup
                </button>
            </div>
        </form>
    </div>

    <!-- form ubah mess  -->
    <div class="card shadow mb-4 card-body text-xs" id="data_ubah_mess" style="display: none;">
        <form class="form-data" method="post" id="form_ubah_mess">
            <input type="hidden" name="u_id_mess" id="u_id_mess">
            <!-- Nama Institusi, MoU RSJ dan Institusi -->
            <div class="row mb-4">
                <div class="col-md">
                    Nama Mess/Pemondokan : <span class="text-danger">*</span>&nbsp;&nbsp;
                    <input class="form-control form-control-sm" name="u_nama_mess" id="u_nama_mess" required>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_nama_mess"></div>
                </div>
                <div class="col-md">
                    Nama Pemilik : <span class="text-danger">*</span>&nbsp;&nbsp;
                    <input class="form-control form-control-sm" name="u_nama_pemilik_mess" id="u_nama_pemilik_mess" required>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_nama_pemilik_mess"></div>
                </div>
                <div class="col-md">
                    Telp. Pemilik : <span class="text-danger">*</span>&nbsp;&nbsp;
                    <input class="form-control form-control-sm" type="number" name="u_telp_pemilik_mess" id="u_telp_pemilik_mess" required>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_telp_pemilik_mess"></div>
                </div>
                <div class="col-md">
                    E-Mail Pemilik : &nbsp;&nbsp;
                    <input class="form-control form-control-sm" type="email" name="u_email_pemilik_mess" id="u_email_pemilik_mess">
                    <!-- <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_email_pemilik_mess"></div> -->
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md">
                    Fasilitas : <span style="color:red">*</span><br>
                    <textarea class="form-control form-control-sm" name="u_fasilitas_mess" id="u_fasilitas_mess" required></textarea>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_fasilitas_mess"></div>
                </div>
                <div class="col-md">
                    Alamat : <span style="color:red">*</span><br>
                    <textarea class="form-control form-control-sm" name="u_alamat_mess" id="u_alamat_mess" required></textarea>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_alamat_mess"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    Tarif Tanpa Makan : (Rp)<span style="color:red">*</span><br>
                    <input type="number" class="form-control form-control-sm" name="u_tarif_tanpa_makan_mess" id="u_tarif_tanpa_makan_mess" required>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_tarif_tanpa_makan_mess"></div>
                </div>
                <div class="col-md-2">
                    Tarif Dengan Makan : (Rp)<span style="color:red">*</span><br>
                    <input type="number" class="form-control form-control-sm" name="u_tarif_dengan_makan_mess" id="u_tarif_dengan_makan_mess" required>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_tarif_dengan_makan_mess"></div>
                </div>
                <div class="col-md-2">
                    Kapasitas Total : <span style="color:red">*</span><br>
                    <input type="number" class="form-control form-control-sm" name="u_kapasitas_total_mess" id="u_kapasitas_total_mess" required>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_kapasitas_total_mess"></div>
                </div>
                <div class="col-md">
                    Kepemilikan : <span class="text-danger">*</span>&nbsp;&nbsp;
                    <select class="select2" name="u_kepemilikan_mess" id="u_kepemilikan_mess" required>
                        <option value=""></option>
                        <option value="dalam">Dalam (RSJ)</option>
                        <option value="luar">Luar</option>
                    </select>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_kepemilikan_mess"></div>
                </div>
                <div class="col-md">
                    Status : <span class="text-danger">*</span>&nbsp;&nbsp;
                    <select class="select2" name="u_status_mess" id="u_status_mess" required>
                        <option value=""></option>
                        <option value="Y">Aktif</option>
                        <option value="T">Non-Aktif</option>
                    </select>
                    <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_status_mess"></div>
                </div>
            </div>
            <hr>
            <div class="form-inline navbar nav-link justify-content-end">
                <button type="button" name="ubah" class="btn btn-primary btn-sm ubah">
                    Ubah
                </button>
                &nbsp;&nbsp;
                <button type="button" class="btn btn-outline-danger btn-sm ubah_tutup">
                    Tutup
                </button>
            </div>
        </form>
    </div>

    <div id="data_mess"></div>
</div>

<script>
    $(document).ready(function() {
        $('#data_mess').load("_admin/view/v_messData.php");
    });

    $(".tambah_init").click(function() {
        // console.log("tambah_init");
        $('#err_t_nama_mess').empty();
        $('#err_t_nama_pemilik_mess').empty();
        $('#err_t_telp_pemilik_mess').empty();
        $('#err_t_kepemilikan_mess').empty();
        $('#err_t_tarif_tanpa_makan_mess').empty();
        $('#err_t_tarif_dengan_makan_mess').empty();
        $('#err_t_kapsitas_total_mess').empty();
        $('#err_t_alamat_mess').empty();
        $('#err_t_fasilitas_mess').empty();

        $('#form_tambah_mess').trigger("reset");
        $('#t_kepemilikan_mess').val('').trigger("change");

        $("#data_tambah_mess").fadeIn(1);
        $("#data_ubah_mess").fadeOut(1);

        $('#t_nama_mess').focus();
    });

    $(".tambah_tutup").click(function() {
        $("#data_tambah_mess").fadeOut(1);
    });

    $(document).on('click', '.tambah', function() {
        var data = $('#form_tambah_mess').serialize();

        var t_nama_mess = $('#t_nama_mess').val();
        var t_nama_pemilik_mess = $('#t_nama_pemilik_mess').val();
        var t_telp_pemilik_mess = $('#t_telp_pemilik_mess').val();
        var t_kepemilikan_mess = $('#t_kepemilikan_mess').val();
        var t_tarif_tanpa_makan_mess = $('#t_tarif_tanpa_makan_mess').val();
        var t_tarif_dengan_makan_mess = $('#t_tarif_dengan_makan_mess').val();
        var t_kapsitas_total_mess = $('#t_kapsitas_total_mess').val();
        var t_alamat_mess = $('#t_alamat_mess').val();
        var t_fasilitas_mess = $('#t_fasilitas_mess').val();

        //cek data from tambah bila tidak diiisi
        if (
            t_nama_mess == "" ||
            t_nama_pemilik_mess == "" ||
            t_telp_pemilik_mess == "" ||
            t_kepemilikan_mess == "" ||
            t_tarif_tanpa_makan_mess == "" ||
            t_tarif_dengan_makan_mess == "" ||
            t_kapsitas_total_mess == "" ||
            t_alamat_mess == "" ||
            t_fasilitas_mess == ""
        ) {
            if (t_nama_mess == "") {
                document.getElementById("err_t_nama_mess").innerHTML = "Nama Mess Harus Diisi";
            } else {
                document.getElementById("err_t_nama_mess").innerHTML = "";
            }

            if (t_nama_pemilik_mess == "") {
                document.getElementById("err_t_nama_pemilik_mess").innerHTML = "Nama Pemilik Harus Diisi";
            } else {
                document.getElementById("err_t_nama_pemilik_mess").innerHTML = "";
            }

            if (t_telp_pemilik_mess == "") {
                document.getElementById("err_t_telp_pemilik_mess").innerHTML = "No. Telp Harus Diisi";
            } else {
                document.getElementById("err_t_telp_pemilik_mess").innerHTML = "";
            }

            if (t_kepemilikan_mess == "") {
                document.getElementById("err_t_kepemilikan_mess").innerHTML = "Kepemilikan Harus Dipilih";
            } else {
                document.getElementById("err_t_kepemilikan_mess").innerHTML = "";
            }

            if (t_tarif_tanpa_makan_mess == "") {
                document.getElementById("err_t_tarif_tanpa_makan_mess").innerHTML = "Tarif Tanpa Makan harus Diisi";
            } else {
                document.getElementById("err_t_tarif_tanpa_makan_mess").innerHTML = "";
            }

            if (t_tarif_dengan_makan_mess == "") {
                document.getElementById("err_t_tarif_dengan_makan_mess").innerHTML = "Tarif Dengan Makan Harus Diisi";
            } else {
                document.getElementById("err_t_tarif_dengan_makan_mess").innerHTML = "";
            }

            if (t_kapsitas_total_mess == "") {
                document.getElementById("err_t_kapsitas_total_mess").innerHTML = "Kapasitas Total Harus Diisi";
            } else {
                document.getElementById("err_t_kapsitas_total_mess").innerHTML = "";
            }

            if (t_alamat_mess == "") {
                document.getElementById("err_t_alamat_mess").innerHTML = "Alamat Harus Diisi";
            } else {
                document.getElementById("err_t_alamat_mess").innerHTML = "";
            }

            if (t_fasilitas_mess == "") {
                document.getElementById("err_t_fasilitas_mess").innerHTML = "Fasiltias Harus Diisi";
            } else {
                document.getElementById("err_t_fasilitas_mess").innerHTML = "";
            }
        }

        if (
            t_nama_mess != "" &&
            t_nama_pemilik_mess != "" &&
            t_telp_pemilik_mess != "" &&
            t_kepemilikan_mess != "" &&
            t_tarif_tanpa_makan_mess != "" &&
            t_tarif_dengan_makan_mess != "" &&
            t_kapsitas_total_mess != "" &&
            t_alamat_mess != "" &&
            t_fasilitas_mess != ""
        ) {
            $.ajax({
                type: 'POST',
                url: "_admin/exc/x_v_mess_s.php",
                data: data,
                success: function() {
                    const SwalButton = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    })
                    SwalButton.fire({
                        allowOutsideClick: false,
                        // isDismissed: false,
                        icon: 'success',
                        title: '<span class"text-xs"><b>Data Mess</b><br>Berhasil Tersimpan',
                        showConfirmButton: true,
                        timer: 5000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', SwalButton.stopTimer)
                            toast.addEventListener('mouseleave', SwalButton.resumeTimer)
                        }
                    }).then((result) => {
                        $('#data_mess').load('_admin/view/v_messData.php');
                        $("#data_tambah_mess").fadeOut(1);
                    });
                },
                error: function(response) {
                    console.log(response.responseText);
                }
            });
        }
    });
</script>