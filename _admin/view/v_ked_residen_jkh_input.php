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
                        <div class="col-md-10  text-light">Data Jadwal Kegiatan Harian</div>
                        <div class="col-md-2 text-right">
                            <a class="btn btn-success btn-sm tambah_init" href="#" data-toggle="modal" data-target="#modal_tambah">
                                <i class="fa-solid fa-plus"></i> Tambah
                            </a>
                            <div class="modal  fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="modal_tambah" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-secondary text-light">
                                            Jadwal Kegiatan Harian
                                            <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close">
                                                X
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form id="form_t" method="post">
                                                <label for="tgl">Tanggal <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="tgl" name="tgl">
                                                <div id="err_tgl" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                <div class="row  mb-2 text-center">
                                                    <div class="col-xl">
                                                        <label for="visite_besar">Visite Besar</label>
                                                        <input type="checkbox" id="visite_besar" name="visite_besar" class="" value="Y">
                                                        <!-- <div id="err_visite_besar" class="i err text-danger text-center text-xs blink mb-2"></div> -->
                                                    </div>
                                                    <div class="col-xl text-center">
                                                        <label for="rapat_klinik">Rapat Klinik</label>
                                                        <input type="checkbox" id="rapat_klinik" name="rapat_klinik" class="" value="Y">
                                                        <!-- <div id="err_rapat_klinik" class="i err text-danger text-center text-xs blink mb-2"></div> -->
                                                    </div>
                                                </div>
                                                <label for="acara_ilmiah">Acara Ilmiah<span class="text-danger">*</span></label>
                                                <textarea id="acara_ilmiah" name="acara_ilmiah" class="form-control" rows="2"></textarea>
                                                <div id="err_acara_ilmiah" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                <label for="matkul_dosen">Mata Kuliah/Dosen<span class="text-danger">*</span></label>
                                                <textarea id="matkul_dosen" name="matkul_dosen" class="form-control" rows="2"></textarea>
                                                <div id="err_matkul_dosen" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                <div class="row">
                                                    <div class="col-xl">
                                                        <label for="j_pasien_rajal">Pasien Rajal<span class="text-danger">*</span></label>
                                                        <input type="number" id="j_pasien_rajal" name="j_pasien_rajal" class="form-control">
                                                        <div id="err_j_pasien_rajal" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    </div>
                                                    <div class="col-xl">
                                                        <label for="j_pasien_ranap">Pasien Ranap<span class="text-danger">*</span></label>
                                                        <input type="number" id="j_pasien_ranap" name="j_pasien_ranap" class="form-control"></input>
                                                        <div id="err_j_pasien_ranap" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    </div>
                                                </div>
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
                    <div id="data_jkh"></div>
                </div>

                <script>
                    $(document).ready(function() {
                        $('#data_jkh')
                            .load(
                                "_admin/view/v_ked_residen_jkh_data.php?idpr=<?= $_GET['data'] ?>");
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
                        // var visite_besar = $("#visite_besar").val();
                        // var rapat_klinik = $("#rapat_klinik").val();
                        var acara_ilmiah = $("#acara_ilmiah").val();
                        var matkul_dosen = $("#matkul_dosen").val();
                        var j_pasien_rajal = $("#j_pasien_rajal").val();
                        var j_pasien_ranap = $("#j_pasien_ranap").val();
                        if (
                            tgl == "" ||
                            // visite_besar == "" ||
                            // rapat_klinik == "" ||
                            acara_ilmiah == "" ||
                            matkul_dosen == "" ||
                            j_pasien_rajal == "" ||
                            j_pasien_ranap == "" ||
                            j_pasien_rajal < 0 ||
                            j_pasien_ranap < 0
                        ) {
                            custom_alert(true, 'warning', '<center>DATA WAJIB ADA YANG BELUM TERISI/TIDAK SESUAI</center>', 10000);
                            (tgl == "") ? $("#err_tgl").html("Pilih Tanggal"): $("#err_tgl").html("");
                            // (visite_besar == "") ? $("#err_visite_besar").html("Isi Visite Besar"): $("#err_visite_besar").html("");
                            // (rapat_klinik == "") ? $("#err_rapat_klinik").html("Pilih Rapat Klinik"): $("#err_rapat_klinik").html("");
                            (acara_ilmiah == "") ? $("#err_acara_ilmiah").html("Harus Diisi"): $("#err_acara_ilmiah").html("");
                            (matkul_dosen == "") ? $("#err_matkul_dosen").html("Harus Diisi"): $("#err_matkul_dosen").html("");
                            (j_pasien_rajal == "" || j_pasien_rajal < 0) ? $("#err_j_pasien_rajal").html("Isian harus lebih sama dengan 0 (Nol)"): $("#err_j_pasien_rajal" + x).html("");
                            (j_pasien_ranap == "" || j_pasien_ranap < 0) ? $("#err_j_pasien_ranap").html("Isian harus lebih sama dengan 0 (Nol)"): $("#err_j_pasien_ranap" + x).html("");
                        } else {
                            $.ajax({
                                type: 'POST',
                                url: "_admin/exc/x_v_ked_residen_jkh_input_t.php",
                                data: data_form,
                                dataType: "JSON",
                                success: function(response) {
                                    if (response.ket == "SUCCESS") {
                                        $('#modal_tambah').modal('hide')
                                        custom_alert(true, 'success', '<center>DATA BERHASIL DISIMPAN</center>', 10000);
                                        loading_sw2();
                                        $('#data_jkh')
                                            .load(
                                                "_admin/view/v_ked_residen_jkh_data.php?idpr=<?= $_GET['data'] ?>");
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