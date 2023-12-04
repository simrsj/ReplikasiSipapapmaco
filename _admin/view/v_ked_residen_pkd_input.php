<div class="container-fluid">
    <?php
    $idpr = urldecode(decryptString($_GET['data'], $customkey));
    try {
        $sql_praktikan = "SELECT * FROM tb_praktikan ";
        $sql_praktikan .= " JOIN tb_praktik ON tb_praktikan.id_praktik = tb_praktik.id_praktik";
        $sql_praktikan .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
        $sql_praktikan .= " WHERE id_praktikan = " .  $idpr;
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
                        <div class="col-md-10  text-light">Data Pencapaian Kompetensi Dasar</div>
                        <div class="col-md-2 text-right">
                            <a class="btn btn-success btn-sm tambah_init" href="#" data-toggle="modal" data-target="#modal_tambah">
                                <i class="fa-solid fa-plus"></i> Tambah
                            </a>
                            <div class="modal" id="modal_tambah">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-secondary text-light">
                                            Pencapaian Kompetensi Dasar
                                            <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close">
                                                X
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form id="form_t" method="post">
                                                <label for="jenis">Jenis <span class="text-danger">*</span></label>
                                                <div class="text-center">
                                                    <select class="select2 text-center" id="jenis" name="jenis">
                                                        <option value=""></option>
                                                        <?php
                                                        try {
                                                            $sql_jenis = "SELECT * FROM `tb_logbook_ked_residen_pkd_jenis`";
                                                            // echo "$sql_jenis<br>";
                                                            $q_jenis = $conn->query($sql_jenis);
                                                        } catch (PDOException $ex) {
                                                        ?>
                                                            <script>
                                                                alert("<?= $ex->getMessage() . $ex->getLine() ?>");
                                                                document.location.href = '?error404';
                                                            </script>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php while ($d_jenis = $q_jenis->fetch(PDO::FETCH_ASSOC)) { ?>
                                                            <option value="<?= $d_jenis['id'] ?>"><?= $d_jenis['nama'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div id="err_jenis" class="i err text-danger text-center text-xs blink mb-2"></div>
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
                                                        <label for="no_rm">No. RM<span class="text-danger">*</span></label>
                                                        <input type="number" min="0" id="no_rm" name="no_rm" class="form-control">
                                                        <div id="err_no_rm" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    </div>
                                                    <div class="col-xl text-center">
                                                        <label for="inisial">Inisial<span class="text-danger">*</span></label>
                                                        <input type="type" id="inisial" name="inisial" class="form-control">
                                                        <div id="err_inisial" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    </div>
                                                </div>
                                                <label for="icd10_diagnosis">ICD-10/Diagnosis<span class="text-danger">*</span></label>
                                                <textarea id="icd10_diagnosis" name="icd10_diagnosis" class="form-control" rows="2"></textarea>
                                                <div id="err_icd10_diagnosis" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                <label for="ket">Th Farmakologis/Manajemen/Sesi ECT/Teknik Psi Suportif/Manajemen/Metode<span class="text-danger">*</span></label>
                                                <textarea id="ket" name="ket" class="form-control" rows="2"></textarea>
                                                <div id="err_ket" class="i err text-danger text-center text-xs blink mb-2"></div>
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
                    <div id="data_pkd"></div>
                </div>

                <script>
                    $(document).ready(function() {
                        $('#data_pkd')
                            .load(
                                "_admin/view/v_ked_residen_pkd_data.php?idpr=<?= $_GET['data'] ?>");
                        $('#loader').remove();
                    });
                    $(".tambah_init").click(function() {
                        $(".err").html("");
                        $("#form_t").trigger("reset");
                        $('#jenis').val("").trigger("change");
                    });
                    $(document).on('click', '.tambah', function() {
                        var data_form = $('#form_t').serializeArray();
                        data_form.push({
                            name: "idpr",
                            value: "<?= $_GET['data'] ?>"
                        });
                        var jenis = $("#jenis").val();
                        var tgl = $("#tgl").val();
                        var semester = $("#semester").val();
                        var no_rm = $("#no_rm").val();
                        var icd10_diagnosis = $("#icd10_diagnosis").val();
                        var ket = $("#ket").val();
                        if (
                            jenis == "" ||
                            semester == "" ||
                            tgl == "" ||
                            no_rm == "" ||
                            icd10_diagnosis == "" ||
                            ket == ""
                        ) {
                            custom_alert(true, 'warning', '<center>DATA WAJIB ADA YANG BELUM TERISI/TIDAK SESUAI</center>', 10000);
                            (jenis == "") ? $("#err_jenis").html("Harus Dipilih"): $("#err_jenis").html("");
                            (tgl == "") ? $("#err_tgl").html("Harus Dipilih"): $("#err_tgl").html("");
                            (semester == "" || semester < 0) ? $("#err_semester").html("Isian harus lebih sama dengan 0 (Nol)"): $("#err_semester").html("");
                            (no_rm == "" || no_rm < 0) ? $("#err_no_rm").html("Isian harus lebih sama dengan 0 (Nol)"): $("#err_no_rm").html("");
                            (icd10_diagnosis == "") ? $("#err_icd10_diagnosis").html("Harus Diisi"): $("#err_icd10_diagnosis").html("");
                            (ket == "") ? $("#err_ket").html("Harus Diisi"): $("#err_ket").html("");
                        } else {
                            $.ajax({
                                type: 'POST',
                                url: "_admin/exc/x_v_ked_residen_pkd_input_t.php",
                                data: data_form,
                                dataType: "JSON",
                                success: function(response) {
                                    if (response.ket == "SUCCESS") {
                                        $('#modal_tambah').modal('hide')
                                        custom_alert(true, 'success', '<center>DATA BERHASIL DIISMPAN</center>', 10000);
                                        loading_sw2();
                                        $('#data_pkd')
                                            .load(
                                                "_admin/view/v_ked_residen_pkd_data.php?idpr=<?= $_GET['data'] ?>");
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