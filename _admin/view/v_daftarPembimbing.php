<?php if (isset($_GET['d_pmbb']) && $d_prvl['r_daftar_pembimbing'] == "Y") { ?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-md">
                <h1 class="h3 mb-2 text-gray-800">Daftar Pembimbing</h1>
            </div>
            <div class="col-md-2 text-right my-auto">
                <button class="btn btn-outline-success btn-sm tambah_init">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
        </div>

        <!-- form tambah pembimbing  -->
        <div class="card shadow mb-4 card-body" id="data_tambah_pembimbing" style="display: none;">
            <form class="form-data" method="post" id="form_tambah_pembimbing">
                <div class="row mb-4">
                    <div class="col-md-3">
                        Nama Pembimbing : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <input class="form-control form-control-sm" name="t_nama_pembimbing" id="t_nama_pembimbing" required>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_nama_pembimbing"></div>
                    </div>
                    <div class="col-md">
                        NIP/NIPK : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <input class="form-control form-control-sm" name="t_nipnipk_pembimbing" id="t_nipnipk_pembimbing" required>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_nipnipk_pembimbing"></div>
                    </div>
                    <div class="col-md-3">
                        Jenis Pembimbing : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <select class="select2" name="t_jenis_pembimbing" id="t_jenis_pembimbing" required>
                            <option value=""></option>
                            <?php
                            $sql_jenis_pmbb = "SELECT * FROM tb_pembimbing_jenis";
                            $sql_jenis_pmbb .= " ORDER BY nama_pembimbing_jenis ASC";

                            $q_jenis_pmbb = $conn->query($sql_jenis_pmbb);
                            while ($d_jenis_pmbb = $q_jenis_pmbb->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?= $d_jenis_pmbb['id_pembimbing_jenis'] ?>">
                                    <?php
                                    echo $d_jenis_pmbb['nama_pembimbing_jenis'] . " (" . $d_jenis_pmbb['akronim_pembimbing_jenis'] . ")";
                                    ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_jenis_pembimbing"></div>
                    </div>
                    <div class="col-md-2">
                        Jenjang Pendidikan : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <select class="select2" name="t_jenjang_pembimbing" id="t_jenjang_pembimbing" required>
                            <option value=""></option>
                            <?php
                            $sql_jenjang_pmbb = "SELECT * FROM tb_jenjang_pdd";
                            $sql_jenjang_pmbb .= " ORDER BY nama_jenjang_pdd ASC";

                            $q_jenjang_pmbb = $conn->query($sql_jenjang_pmbb);
                            while ($d_jenjang_pmbb = $q_jenjang_pmbb->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?= $d_jenjang_pmbb['id_jenjang_pdd'] ?>">
                                    <?php
                                    echo $d_jenjang_pmbb['nama_jenjang_pdd'];
                                    ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_jenjang_pembimbing"></div>
                    </div>
                    <div class="col-md-1">
                        Kali : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <input class="form-control form-control-sm" type="number" maxlength="1" name="t_kali_pembimbing" id="t_kali_pembimbing" required>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_t_kali_pembimbing"></div>
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

        <!-- form ubah pembimbing  -->
        <div class="card shadow mb-4 card-body" id="data_ubah_pembimbing" style="display: none;">
            <form class="form-data" method="post" id="form_ubah_pembimbing">
                <!-- Nama Institusi, MoU RSJ dan Institusi -->
                <input type="hidden" name="u_id_pembimbing" id="u_id_pembimbing">
                <div class="row mb-4">
                    <div class="col-md">
                        Nama Pembimbing : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <input class="form-control form-control-sm" name="u_nama_pembimbing" id="u_nama_pembimbing" required>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_nama_pembimbing"></div>
                    </div>
                    <div class="col-md">
                        NIP/NIPK : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <input class="form-control form-control-sm" name="u_nipnipk_pembimbing" id="u_nipnipk_pembimbing" required>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_nipnipk_pembimbing"></div>
                    </div>
                    <div class="col-md-3">
                        Jenis Pembimbing : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <select class="select2" name="u_jenis_pembimbing" id="u_jenis_pembimbing" required>
                            <option value=""></option>
                            <?php
                            $sql_jenis_pmbb = "SELECT * FROM tb_pembimbing_jenis";
                            $sql_jenis_pmbb .= " ORDER BY nama_pembimbing_jenis ASC";

                            $q_jenis_pmbb = $conn->query($sql_jenis_pmbb);
                            while ($d_jenis_pmbb = $q_jenis_pmbb->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?= $d_jenis_pmbb['id_pembimbing_jenis'] ?>">
                                    <?php
                                    echo $d_jenis_pmbb['nama_pembimbing_jenis'] . " (" . $d_jenis_pmbb['akronim_pembimbing_jenis'] . ")";
                                    ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_jenis_pembimbing"></div>
                    </div>
                    <div class="col-md-2">
                        Jenjang : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <select class="select2" name="u_jenjang_pembimbing" id="u_jenjang_pembimbing" required>
                            <option value=""></option>
                            <?php
                            $sql_jenjang_pmbb = "SELECT * FROM tb_jenjang_pdd";
                            $sql_jenjang_pmbb .= " ORDER BY nama_jenjang_pdd ASC";

                            $q_jenjang_pmbb = $conn->query($sql_jenjang_pmbb);
                            while ($d_jenjang_pmbb = $q_jenjang_pmbb->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?= $d_jenjang_pmbb['id_jenjang_pdd'] ?>">
                                    <?php
                                    echo $d_jenjang_pmbb['nama_jenjang_pdd'];
                                    ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_jenjang_pembimbing"></div>
                    </div>
                    <div class="col-md-1">
                        Kali : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <input class="form-control form-control-sm" type="number" maxlength="1" name="u_kali_pembimbing" id="u_kali_pembimbing" required>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_kali_pembimbing"></div>
                    </div>
                    <div class="col-md">
                        Status : <span class="text-danger">*</span>&nbsp;&nbsp;
                        <select class="select2" name="u_status_pembimbing" id="u_status_pembimbing" required>
                            <option value=""></option>
                            <option value="Y">Aktif</option>
                            <option value="T">Non-Aktif</option>
                        </select>
                        <div class="text-danger font-weight-bold font-italic text-xs blink" id="err_u_status_pembimbing"></div>
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

        <div id="data_daftarPembimbing"></div>
    </div>
    <script>
        $(document).ready(function() {
            $('#data_daftarPembimbing').load("_admin/view/v_daftarPembimbingData.php");
        });

        $(".tambah_init").click(function() {
            // console.log("tambah_init")''
            $('#err_t_nama_pembimbing').empty();
            $('#err_t_nipnipk_pembimbing').empty();
            $('#err_t_jenis_pembimbing').empty();
            $('#err_t_jenjang_pembimbing').empty();
            $('#err_t_kali_pembimbing').empty();

            $('#form_tambah_pembimbing').trigger("reset");
            $('#t_jenis_pembimbing').val('').trigger("change");
            $('#t_jenjang_pembimbing').val('').trigger("change");

            $("#data_tambah_pembimbing").fadeIn(1);
            $("#data_ubah_pembimbing").fadeOut(1);

            $('#t_nama_pembimbing').focus();
        });

        $(".tambah_tutup").click(function() {
            $('#err_t_nama_pembimbing').empty();
            $('#err_t_nipnipk_pembimbing').empty();
            $('#err_t_jenis_pembimbing').empty();
            $('#err_t_jenjang_pembimbing').empty();
            $('#err_t_kali_pembimbing').empty();

            $('#form_tambah_pembimbing').trigger("reset");
            $('#t_jenis_pembimbing').val('').trigger("change");
            $('#t_jenjang_pembimbing').val('').trigger("change");

            $("#data_tambah_pembimbing").fadeOut(1);
        });

        $(document).on('click', '.tambah', function() {
            var data = $('#form_tambah_pembimbing').serialize();

            var t_nama_pembimbing = $('#t_nama_pembimbing').val();
            var t_nipnipk_pembimbing = $('#t_nipnipk_pembimbing').val();
            var t_jenis_pembimbing = $('#t_jenis_pembimbing').val();
            var t_jenjang_pembimbing = $('#t_jenjang_pembimbing').val();
            var t_kali_pembimbing = $('#t_kali_pembimbing').val();

            //cek data from tambah bila tidak diiisi
            if (
                t_nama_pembimbing == "" ||
                t_nipnipk_pembimbing == "" ||
                t_jenis_pembimbing == "" ||
                t_jenjang_pembimbing == "" ||
                t_kali_pembimbing == ""
            ) {
                if (t_nama_pembimbing == "") {
                    document.getElementById("err_t_nama_pembimbing").innerHTML = "Nama Pembimbing Harus Diisi";
                } else {
                    document.getElementById("err_t_nama_pembimbing").innerHTML = "";
                }

                if (t_nipnipk_pembimbing == "") {
                    document.getElementById("err_t_nipnipk_pembimbing").innerHTML = "NIP/NIPK Harus Diisi";
                } else {
                    document.getElementById("err_t_nipnipk_pembimbing").innerHTML = "";
                }

                if (t_jenis_pembimbing == "") {
                    document.getElementById("err_t_jenis_pembimbing").innerHTML = "Jenis Pembimbing Harus Dipilih";
                } else {
                    document.getElementById("err_t_jenis_pembimbing").innerHTML = "";
                }

                if (t_jenjang_pembimbing == "") {
                    document.getElementById("err_t_jenjang_pembimbing").innerHTML = "Jenjang Pembimbing Harus Dipilih";
                } else {
                    document.getElementById("err_t_jenjang_pembimbing").innerHTML = "";
                }

                if (t_kali_pembimbing == "") {
                    document.getElementById("err_t_kali_pembimbing").innerHTML = "Kali Membimbing Harus Diisi";
                } else {
                    document.getElementById("err_t_kali_pembimbing").innerHTML = "";
                }
            }

            if (
                t_nama_pembimbing != "" &&
                t_nipnipk_pembimbing != "" &&
                t_jenis_pembimbing != "" &&
                t_jenjang_pembimbing != "" &&
                t_kali_pembimbing != ""
            ) {
                $.ajax({
                    type: 'POST',
                    url: "_admin/exc/x_v_daftarPembimbing_s.php",
                    data: data,
                    success: function() {
                        Swal.fire({
                            allowOutsideClick: false,
                            // isDismissed: false,
                            icon: 'success',
                            title: '<span class"text-xs"><b>Data Pembimbing</b><br>Berhasil Tersimpan',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });;

                        $('#data_daftarPembimbing').load('_admin/view/v_daftarPembimbingData.php');

                        document.getElementById("err_t_nama_pembimbing").innerHTML = "";
                        document.getElementById("err_t_nipnipk_pembimbing").innerHTML = "";
                        document.getElementById("err_t_jenis_pembimbing").innerHTML = "";
                        document.getElementById("err_t_jenjang_pembimbing").innerHTML = "";
                        document.getElementById("err_t_kali_pembimbing").innerHTML = "";
                        document.getElementById("form_tambah_pembimbing").reset();
                        $("#data_tambah_pembimbing").fadeOut(1);
                    },
                    error: function(response) {
                        console.log(response.responseText);
                    }
                });
            }
        });
    </script>
<?php } else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}
