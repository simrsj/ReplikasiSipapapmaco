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
        echo "<script>alert('ERROR DATA BIMBINGAN PRAKTIKAN')</script>;";
        echo "<script>document.location.href='?error404';</script>";
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
                                                <label for="tgl">Tanggal</label>
                                                <input type="date" class="form-control" id="tgl" name="tgl">
                                                <div id="err_tgl" class="i text-danger text-center text-xs blink  mb-2"></div>
                                                <label for="kegiatan">Kegiatan</label>
                                                <textarea id="kegiatan" name="kegiatan" class="form-control " rows="3"></textarea>
                                                <div id="err_kegiatan" class="i text-danger text-center text-xs blink  mb-2"></div>
                                                <label for="topik">Topik</label>
                                                <textarea id="topik" name="topik" class="form-control" rows="3"></textarea>
                                                <div id="err_topik" class="i text-danger text-center text-xs blink"></div>
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
                                "_admin/view/v_ked_coass_jkh_data.php?idpr=<?= $_GET['data'] ?>");
                        $('#loader').remove();

                    });
                    $(".tambah_init").click(function() {
                        $('#tgl').attr('class', 'form-control');
                        $("#err_tgl").html("");
                        $('#kegiatan').attr('class', 'form-control');
                        $("#err_kegiatan").html("");
                        $('#topik').attr('class', 'form-control');
                        $("#err_topik").html("");
                        $("#form_t").trigger("reset");
                    });
                    $(document).on('click', '.tambah', function() {
                        var data_form = $('#form_t').serializeArray();
                        data_form.push({
                            name: "idpr",
                            value: "<?= $_GET['data'] ?>"
                        });
                        var tgl = $("#tgl").val();
                        var kegiatan = $("#kegiatan").val();
                        var topik = $("#topik").val();
                        if (
                            tgl == "" ||
                            kegiatan == "" ||
                            topik == ""
                        ) {
                            simpan_tidaksesuai();
                            if (tgl == "") {
                                $('#tgl').attr('class', 'border-danger border-2  form-control');
                                $("#err_tgl").html("Pilih Tanggal");
                            } else {
                                $('#tgl').attr('class', 'form-control');
                                $("#err_tgl").html("");
                            }

                            if (kegiatan == "") {
                                $('#kegiatan').attr('class', 'border-danger border-2 form-control');
                                $("#err_kegiatan").html("Isikan Kegiatan");
                            } else {
                                $('#kegiatan').attr('class', 'form-control');
                                $("#err_kegiatan").html("");
                            }

                            if (topik == "") {
                                $('#topik').attr('class', 'border-danger border-2 form-control');
                                $("#err_topik").html("Isikan Topik");
                            } else {
                                $('#topik').attr('class', 'form-control');
                                $("#err_topik").html("");
                            }
                        } else {
                            $.ajax({
                                type: 'POST',
                                url: "_admin/exc/x_v_ked_coass_jkh_input_t.php",
                                data: data_form,
                                dataType: "JSON",
                                success: function(response) {
                                    if (response.ket == "SUCCESS") {
                                        $('#modal_tambah').modal('hide')
                                        simpan_berhasil("");
                                        loading_sw2();
                                        $('#data_jkh')
                                            .load(
                                                "_admin/view/v_ked_coass_jkh_data.php?idpr=<?= $_GET['data'] ?>");
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