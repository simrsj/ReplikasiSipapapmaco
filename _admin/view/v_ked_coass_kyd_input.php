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
        echo "<script>alert('DATA PRAKTIKAN')</script>;";
        echo "<script>document.location.href='?error404';</script>";
    }
    ?>
    <div class="card shadow  m-2">
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
                <div class="card-header b between bg-dark ">
                    <div class="row">
                        <div class="col-md-10 text-light">Data Kejadian Yang Ditemukan</div>
                        <div class="col-md-2 text-right">
                            <a class="btn btn-success btn-sm tambah_init" href="#" data-toggle="modal" data-target="#modal_tambah">
                                <i class="fa-solid fa-plus"></i> Tambah
                            </a>
                            <div class="modal  fade" id="modal_tambah" role="dialog" aria-labelledby="modal_tambah" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-light">
                                            Kejadian Yang Ditemukan
                                            <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close">
                                                X
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form id="form_t" method="post">
                                                <label for="ruang">Ruang</label>
                                                <select class="form-control" id="ruang" name="ruang">
                                                    <option value="" class="text-center">-- Pilih --</option>
                                                    <option value="Poliklinik/Rawat Jalan">Poliklinik/Rawat Jalan</option>
                                                    <option value="Intensif/Rawat Inap">Intensif/Rawat Inap</option>
                                                    <option value="IGD">IGD</option>
                                                    <option value="Rehabilitasi Napza">Rehabilitasi Napza</option>
                                                    <option value="ECT">ECT</option>
                                                </select>
                                                <div id="err_ruang" class="err i text-danger text-center text-xs blink mb-2"></div>

                                                <label for="tgl">Tanggal</label>
                                                <input class="form-control" type="date" id="tgl" name="tgl">
                                                <div id="err_tgl" class="err i text-danger text-center text-xs blink mb-2"></div>

                                                <label for="nama_pasien">Nama Pasien</label>
                                                <input class="form-control" id="nama_pasien" name="nama_pasien">
                                                <div id="err_nama_pasien" class="err i text-danger text-center text-xs blink mb-2"></div>

                                                <div class="row">
                                                    <div class="col-md">
                                                        <label for="usia">Usia</label>
                                                        <input class="form-control" type="number" min="0" id="usia" name="usia">
                                                        <div class="i text-center text-xs "><label for="usia" class="m-0">Isian Hanya Angka</label></div>
                                                        <div id="err_usia" class="err i text-danger text-center text-xs blink mb-2"></div>
                                                    </div>
                                                    <div class="col-md">
                                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                                            <option value="" class="text-center">-- Pilih --</option>
                                                            <option value="L">Laki-laki</option>
                                                            <option value="P">Perempuan</option>
                                                        </select>
                                                        <div id="err_jenis_kelamin" class="err i text-danger text-center text-xs blink mb-2"></div>
                                                    </div>
                                                </div>


                                                <label for="medrec">Medrec</label>
                                                <input class="form-control " id="medrec" name="medrec">
                                                <div id="err_medrec" class="err i text-danger text-center text-xs blink mb-2"></div>

                                                <label for="diagnosis">Diagnosis</label>
                                                <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3"></textarea>
                                                <div id="err_diagnosis" class="err i text-danger text-center text-xs blink mb-2"></div>

                                                <label for="terapi">Terapi</label>
                                                <textarea class="form-control" id="terapi" name="terapi" rows="3"></textarea>
                                                <div id="err_terapi" class="err i text-danger text-center text-xs blink"></div>
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
                    <div id="data_kyd"></div>
                </div>

                <script>
                    $(document).ready(function() {
                        $('#data_kyd')
                            .load(
                                "_admin/view/v_ked_coass_kyd_data.php?idpr=<?= $_GET['data'] ?>");
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
                        var ruang = $("#ruang").val();
                        var tgl = $("#tgl").val();
                        var nama_pasien = $("#nama_pasien").val();
                        var usia = $("#usia").val();
                        var jenis_kelamin = $("#jenis_kelamin").val();
                        var medrec = $("#medrec").val();
                        var diagnosis = $("#diagnosis").val();
                        var terapi = $("#terapi").val();
                        if (
                            ruang == "" ||
                            tgl == "" ||
                            nama_pasien == "" ||
                            usia == "" ||
                            jenis_kelamin == "" ||
                            medrec == "" ||
                            diagnosis == "" ||
                            terapi == ""
                        ) {
                            simpan_tidaksesuai();
                            ruang == "" ? $("#err_ruang").html("Pilih Ruang") : $("#err_ruang").html("");
                            tgl == "" ? $("#err_tgl").html("Pilih Tanggal") : $("#err_tgl").html("");
                            nama_pasien == "" ? $("#err_nama_pasien").html("Isikan Nama Pasien") : $("#err_nama_pasien").html("")
                            usia == "" ? $("#err_usia").html("Isikan Usia") : $("#err_usia").html("")
                            jenis_kelamin == "" ? $("#err_jenis_kelamin").html("Pilih Jenis Kelamin") : $("#err_jenis_kelamin").html("")
                            medrec == "" ? $("#err_medrec").html("Isikan Medrec") : $("#err_medrec").html("")
                            diagnosis == "" ? $("#err_diagnosis").html("Isikan Diagnosis") : ("#err_diagnosis").html("")
                            terapi == "" ? $("#err_terapi").html("Isikan Terapi") : $("#err_terapi").html("")
                        } else {
                            $.ajax({
                                type: 'POST',
                                url: "_admin/exc/x_v_ked_coass_kyd_input_t.php",
                                data: data_form,
                                dataType: "JSON",
                                success: function(response) {
                                    if (response.ket == "SUCCESS") {
                                        $('#modal_tambah').modal('hide')
                                        simpan_berhasil("");
                                        loading_sw2();
                                        $('#data_kyd')
                                            .load(
                                                "_admin/view/v_ked_coass_kyd_data.php?idpr=<?= $_GET['data'] ?>");
                                    } else simpan_gagal_database();
                                },
                                error: function(response) {
                                    console.log(response.ket);
                                }
                            });
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>