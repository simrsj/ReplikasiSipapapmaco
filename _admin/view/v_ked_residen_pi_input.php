<div class="container-fluid">
    <?php
    $idpr = urldecode(decryptString($_GET['data'], $customkey));
    try {
        $sql_praktikan = "SELECT * FROM tb_praktikan ";
        $sql_praktikan .= " JOIN tb_praktik ON tb_praktikan.id_praktik = tb_praktik.id_praktik";
        $sql_praktikan .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
        $sql_praktikan .= " WHERE id_praktikan = " . $idpr;
        // echo "$sql_praktikan<br>";
        $q_praktikan = $conn->query($sql_praktikan);
        $d_praktikan = $q_praktikan->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
    ?>
        <script>
            alert("<?= $ex->getMessage() . $ex->getLine() ?>");
            document.location.href = '?error404';
        </script>
    <?php
    }
    ?>
    <div class="card shadow m-2">
        <div class="card-header b text-center bg-dark text-light">
            Data Praktikan
        </div>
        <div class="card-body text-center">
            <div class="row">
                <div class="col-md">
                    <img height="100" height="80" src="<?= $d_praktikan['foto_praktikan'] ?>">
                </div>
                <div class="col-md">
                    Nama Praktikan : <br>
                    <strong><?= $d_praktikan['nama_praktikan'] ?></strong><br>
                    No. ID Praktikan : <br>
                    <strong><?= $d_praktikan['no_id_praktikan'] ?></strong>
                </div>
                <div class="col-md">
                    Nama Institusi : <br>
                    <strong> <?= $d_praktikan['nama_institusi'] ?> </strong><br>
                    Nama Kelompok/Gelombang/Praktik : <br>
                    <strong> <?= $d_praktikan['nama_praktik'] ?></strong>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div class="card shadow m-2 rounded-5">
                <div class="card-header b between  bg-dark">
                    <div class="row">
                        <div class="col-md-10  text-light">Data Presentasi Ilmiah</div>
                        <div class="col-md-2 text-right">
                            <a class="btn btn-success btn-sm tambah_init" href="#" data-toggle="modal" data-target="#modal_tambah">
                                <i class="fa-solid fa-plus"></i> Tambah
                            </a>
                            <div class="modal" id="modal_tambah">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-secondary text-light">
                                            Presentasi Ilmiah
                                            <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close">
                                                X
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form id="form_t" method="post">
                                                <label for="tgl">Tanggal <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="tgl" name="tgl">
                                                <div id="err_tgl" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                <div class="row mb-2 text-center">
                                                    <div class="col-xl">
                                                        <label for="semester">Semester<span class="text-danger">*</span></label>
                                                        <input type="number" min="0" id="semester" name="semester" class="form-control">
                                                        <div id="err_semester" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    </div>
                                                    <div class="col-xl text-center">
                                                        <label for="jenis">Jenis<span class="text-danger">*</span></label>
                                                        <input id="jenis" name="jenis" class="form-control">
                                                        <div id="err_jenis" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    </div>
                                                </div>
                                                <label for="judul">Judul<span class="text-danger">*</span></label>
                                                <textarea id="judul" name="judul" class="form-control" rows="2"></textarea>
                                                <div id="err_judul" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                <div class="row mb-2 text-center">
                                                    <div class="col-xl">
                                                        <label for="bim1">Bim 1<span class="text-danger">*</span></label>
                                                        <input type="date" id="bim1" name="bim1" class="form-control">
                                                        <div id="err_bim1" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    </div>
                                                    <div class="col-xl text-center">
                                                        <label for="bim2">Bim 2<span class="text-danger">*</span></label>
                                                        <input type="date" id="bim2" name="bim2" class="form-control">
                                                        <div id="err_bim2" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    </div>
                                                    <div class="col-xl text-center">
                                                        <label for="bim3">Bim 3<span class="text-danger">*</span></label>
                                                        <input type="date" id="bim3" name="bim3" class="form-control">
                                                        <div id="err_bim3" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    </div>
                                                    <div class="col-xl text-center">
                                                        <label for="present">Present<span class="text-danger">*</span></label>
                                                        <input type="date" id="present" name="present" class="form-control">
                                                        <div id="err_present" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    </div>
                                                </div>
                                                <label for="pembimbing">Pembimbing<span class="text-danger">*</span></label>
                                                <input id="pembimbing" name="pembimbing" class="form-control">
                                                <div id="err_pembimbing" class="i err text-danger text-center text-xs blink mb-2"></div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-success btn-sm tambah"><i class="fa fa-save"></i> Simpan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="data">
                    <div id="loader" class="loader mb-5 mt-5 text-center"></div>
                    <div id="data_pi"></div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#data_pi')
                            .load(
                                "_admin/view/v_ked_residen_pi_data.php?idpr=<?= $_GET['data'] ?>");
                        $('#loader').remove();
                    });
                    $(".tambah_init").click(function() {
                        $(".err").html("");
                        $("#form_t").trigger("reset");
                    });
                    $(document).on('click', '.tambah', function() {
                        var data_form = $('#form_t').serializeArray();
                        data_form.push({
                            name: "idpr",
                            value: "<?= $_GET['data'] ?>"
                        });
                        var tgl = $("#tgl").val();
                        var semester = $("#semester").val();
                        var jenis = $("#jenis").val();
                        var judul = $("#judul").val();
                        var bim1 = $("#bim1").val();
                        var bim2 = $("#bim2").val();
                        var bim3 = $("#bim3").val();
                        var present = $("#present").val();
                        var pembimbing = $("#pembimbing").val();
                        if (
                            semester == "" ||
                            tgl == "" ||
                            jenis == "" ||
                            judul == "" ||
                            bim1 == "" ||
                            bim2 == "" ||
                            bim3 == "" ||
                            present == "" ||
                            pembimbing == ""
                        ) {
                            custom_alert(true, 'warning', '<center>DATA WAJIB ADA YANG BELUM TERISI/TIDAK SESUAI</center>', 10000);
                            (tgl == "") ? $("#err_tgl").html("Harus Dipilih"): $("#err_tgl").html("");
                            (semester == "" || semester < 0) ? $("#err_semester").html("Isian harus lebih sama dengan 0 (Nol)"): $("#err_semester").html("");
                            (jenis == "") ? $("#err_jenis").html("Harus Diisi"): $("#err_jenis").html("");
                            (judul == "") ? $("#err_judul").html("Harus Diisi"): $("#err_judul").html("");
                            (bim1 == "") ? $("#err_bim1").html("Harus Dipilih"): $("#err_bim1").html("");
                            (bim2 == "") ? $("#err_bim2").html("Harus Dipilih"): $("#err_bim2").html("");
                            (bim3 == "") ? $("#err_bim3").html("Harus Dipilih"): $("#err_bim3").html("");
                            (present == "") ? $("#err_present").html("Harus Dipilih"): $("#err_present").html("");
                            (pembimbing == "") ? $("#err_pembimbing").html("Harus Diisi"): $("#err_pembimbing").html("");
                        } else {
                            $.ajax({
                                type: 'POST',
                                url: "_admin/exc/x_v_ked_residen_pi_input_t.php",
                                data: data_form,
                                dataType: "JSON",
                                success: function(response) {
                                    if (response.ket == "SUCCESS") {
                                        $('#modal_tambah').modal('hide')
                                        custom_alert(true, 'success', '<center>DATA BERHASIL DISIMPAN</center>', 10000);
                                        loading_sw2();
                                        $('#data_pi')
                                            .load(
                                                "_admin/view/v_ked_residen_pi_data.php?idpr=<?= $_GET['data'] ?>");
                                    } else custom_alert(true, 'error', '<center>DATA GAGAL DISIMPAN <br>' + response.ket + '</center>', 10000);
                                },
                                error: function(response) {
                                    custom_alert(true, 'error', '<center>DATA ERROR <br>' + response.ket + '</center>', 10000);
                                }
                            });
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>