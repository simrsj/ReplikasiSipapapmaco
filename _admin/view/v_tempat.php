<div class="data_tempat">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="h3 mb-2 text-gray-800">Daftar Tempat</h1>
            </div>
            <div class="col-lg-2 text-right justify-content-center">
                <button class='btn btn-outline-success btn-sm tambah_init'>
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
        </div>

        <!-- form tambah tempat  -->
        <div class="card shadow mb-4 card-body" id="data_tambah_tempat" style="display: none;">
            <form class="form-data" method="post" id="form_tambah_tempat">
                <div class="row mb-4">
                    <div class="col-md ">
                        Nama Tempat : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <input class="form-control" name="t_nama_tempat" id="t_nama_tempat" required>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_nama_tempat"></div>
                    </div>
                    <div class="col-md">
                        Kapasitas : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <input class="form-control" name="t_kapasitas_tempat" id="t_kapasitas_tempat" required>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_kapasitas_tempat"></div>
                    </div>
                    <div class="col-md">
                        Tarif (Rp) : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <input class="form-control" name="t_tarif_tempat" id="t_tarif_tempat" required>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_tarif_tempat"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        Satuan : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <select class='select2' name='t_tarif_satuan' id="t_tarif_satuan" style="width: 100%;" required>
                            <option value="">-- <i>Pilih</i>--</option>
                            <?php
                            $sql_satuan = "SELECT * FROM tb_tarif_satuan";
                            $sql_satuan .= " ORDER BY nama_tarif_satuan ASC";
                            $q_satuan = $conn->query($sql_satuan);
                            while ($d_satuan = $q_satuan->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value='<?= $d_satuan['id_tarif_satuan']; ?>'>
                                    <?= $d_satuan['nama_tarif_satuan']; ?>
                                </option>
                            <?php
                                $no++;
                            }
                            ?>
                        </select>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_tarif_satuan"></div>
                    </div>
                    <div class="col-md">
                        Jenis Jurusan : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <select class='select2' name='t_jenis_jurusan' id="t_jenis_jurusan" style="width: 100%;" required>
                            <option value=""></option>
                            <option value="0">-- Lainnya --</option>
                            <option value="1">Kedokteran</option>
                            <option value="2">Keperawatan</option>
                            <option value="3">Nakes Lainnya</option>
                            <option value="4">Non-Nakes</option>
                        </select>
                        <div class="font-italic text-xs">Bila tempat untuk semua jenis jurusan pilih <b>-- Lainnya --</b></div>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_jenis_jurusan"></div>
                    </div>
                    <div class="col-md">
                        Keterangan : <br>
                        <textarea name="t_ket_tempat" id="t_ket_tempat" class="form-control"></textarea>
                    </div>
                    <hr>
                </div>
                <hr>
                <div class="form-inline navbar nav-link justify-content-end">
                    <button type="button" name="tambah" class="btn btn-success btn-sm mb-2 tambah">
                        Tambah
                    </button>
                    &nbsp;&nbsp;
                    <button type="button" class="btn btn-outline-danger btn-sm mb-2 tambah_tutup">
                        Tutup
                    </button>
                </div>
            </form>
        </div>

        <!-- form ubah tempat  -->
        <div class="card shadow mb-4 card-body" id="data_ubah_tempat" style="display: none;">
            <form class="form-data" method="post" id="form_ubah_tempat">
                <input type="hidden" name="u_id_tempat" id="u_id_tempat">
                <div class="row mb-4">
                    <div class="col-md ">
                        Nama Tempat : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <input class="form-control" name="u_nama_tempat" id="u_nama_tempat" required>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_nama_tempat"></div>
                    </div>
                    <div class="col-md">
                        Kapasitas : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <input class="form-control" name="u_kapasitas_tempat" id="u_kapasitas_tempat" required>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_kapasitas_tempat"></div>
                    </div>
                    <div class="col-md">
                        Tarif (Rp) : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <input class="form-control" name="u_tarif_tempat" id="u_tarif_tempat" required>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_tarif_tempat"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        Satuan : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <select class='select2' name='u_tarif_satuan' id="u_tarif_satuan" style="width: 100%;" required>
                            <option value="">-- <i>Pilih</i>--</option>
                            <?php
                            $sql_satuan = "SELECT * FROM tb_tarif_satuan";
                            $sql_satuan .= " ORDER BY nama_tarif_satuan ASC";
                            $q_satuan = $conn->query($sql_satuan);
                            while ($d_satuan = $q_satuan->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value='<?= $d_satuan['id_tarif_satuan']; ?>'>
                                    <?= $d_satuan['nama_tarif_satuan']; ?>
                                </option>
                            <?php
                                $no++;
                            }
                            ?>
                        </select>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_tarif_satuan"></div>
                    </div>
                    <div class="col-md">
                        Jenis Jurusan : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <select class='select2' name='u_jenis_jurusan' id="u_jenis_jurusan" style="width: 100%;" required>
                            <option value=""></option>
                            <option value="0">-- Lainnya --</option>
                            <option value="1">Kedokteran</option>
                            <option value="2">Keperawatan</option>
                            <option value="3">Nakes Lainnya</option>
                            <option value="4">Non-Nakes</option>
                        </select>
                        <div class="font-italic text-xs">Bila tempat untuk semua jenis jurusan pilih <b>-- Lainnya --</b></div>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_jenis_jurusan"></div>
                    </div>
                    <div class="col-md">
                        Status : <br>
                        <select class='select2' name='u_status_tempat' id="u_status_tempat" style="width: 100%;" required>
                            <option value=""></option>
                            <option value="Y">AKTIF</option>
                            <option value="T">TIDAK AKTIF</option>
                        </select>
                    </div>
                    <div class="col-md">
                        Keterangan : <br>
                        <textarea name="u_ket_tempat" id="u_ket_tempat" class="form-control"></textarea>
                    </div>
                    <hr>
                </div>
                <hr>
                <div class="form-inline navbar nav-link justify-content-end">
                    <button type="button" name="ubah" class="btn btn-primary btn-sm mb-2 ubah">
                        Ubah
                    </button>
                    &nbsp;&nbsp;
                    <button type="button" class="btn btn-outline-danger btn-sm mb-2 ubah_tutup">
                        Tutup
                    </button>
                </div>
            </form>
        </div>

        <div id="data_tempat"></div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#data_tempat').load("_admin/view/v_tempatData.php");
    });

    $(".tambah_init").click(function() {
        $("#err_t_nama_tempat").html("");
        $("#err_t_kapasitas_tempat").html("");
        $("#err_t_tarif_tempat").html("");
        $("#err_t_tarif_satuan").html("");
        $("#err_t_jenis_jurusan").html("");
        $("#form_tambah_tempat").reset();
        $("#data_tambah_tempat").fadeIn(1);
        $("#data_ubah_tempat").fadeOut(1);
        $('#t_nama_tempat').focus();
    });

    $(".tambah_tutup").click(function() {
        $("#err_t_nama_tempat").html("");
        $("#err_t_kapasitas_tempat").html("");
        $("#err_t_tarif_tempat").html("");
        $("#err_t_tarif_satuan").html("");
        $("#err_t_jenis_jurusan").html("");
        $("#form_tambah_tempat").reset();
        $("#data_tambah_tempat").fadeOut(1);
    });

    $(document).on('click', '.tambah', function() {
        var data = $('#form_tambah_tempat').serialize();

        var t_nama_tempat = $('#t_nama_tempat').val();
        var t_kapasitas_tempat = $('#t_kapasitas_tempat').val();
        var t_tarif_tempat = $('#t_tarif_tempat').val();
        var t_tarif_satuan = $('#t_tarif_satuan').val();
        var t_jenis_jurusan = $('#t_jenis_jurusan').val();
        var t_ket_tempat = $('#t_ket_tempat').val();

        //cek data from tambah bila tidak diiisi
        if (
            t_nama_tempat == "" ||
            t_kapasitas_tempat == "" ||
            t_tarif_tempat == "" ||
            t_tarif_satuan == "" ||
            t_jenis_jurusan == ""
        ) {
            if (t_nama_tempat == "") {
                $("#err_t_nama_tempat").html("Nama Harus Diisi");
            } else {
                $("#err_t_nama_tempat").html("");
            }

            if (t_kapasitas_tempat == "") {
                $("#err_t_kapasitas_tempat").html("Kapasitas Harus Diisi");
            } else {
                $("#err_t_kapasitas_tempat").html("");
            }

            if (t_tarif_tempat == "") {
                $("#err_t_tarif_tempat").html("Tarif Harus Diisi");
            } else {
                $("#err_t_tarif_tempat").html("");
            }

            if (t_tarif_satuan == "") {
                $("#err_t_tarif_satuan").html("Satuan Harus Dipilih");
            } else {
                $("#err_t_tarif_satuan").html("");
            }

            if (t_jenis_jurusan == "") {
                $("#err_t_jenis_jurusan").html("Jenis jurusan Harus Dipilih");
            } else {
                $("#err_t_jenis_jurusan").html("");
            }

        } else {
            $.ajax({
                type: 'POST',
                url: "_admin/exc/x_v_tempat_s.php",
                data: data,
                success: function() {

                    $('#data_tempat').load('_admin/view/v_tempatData.php?');

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
                        title: '<div class="text-center font-weight-bold text-uppercase">Data Berhasil Ditambah</b></div>'
                    });
                    $("#err_t_nama_tempat").html("");
                    $("#err_t_kapasitas_tempat").html("");
                    $("#err_t_tarif_tempat").html("");
                    $("#err_t_tarif_satuan").html("");
                    $("#err_t_jenis_jurusan").html("");
                    $("#form_tambah_tempat").reset();
                },
                error: function(response) {
                    console.log(response.responseText);
                }
            });
        }
    });
</script>