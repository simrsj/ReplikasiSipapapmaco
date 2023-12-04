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
        echo "<script>alert('$ex')</script>;";
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
                <div class="card-header b between bg-dark">
                    <div class="row">
                        <div class="col-md-10 text-light">Daftar Materi</div>
                        <div class="col-md-2 text-right">
                            <a class="btn btn-success btn-sm tambah_init" href="#" data-toggle="modal" data-target="#modal_tambah">
                                <i class="fa-solid fa-plus"></i> Tambah
                            </a>
                            <div class="modal  fade" id="modal_tambah" role="dialog" aria-labelledby="modal_tambah" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-light">
                                            Tambah Materi
                                            <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close">
                                                X
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form id="form_t" method="post">
                                                <label for="materi">Materi</label>
                                                <select class="form-control" id="materi" name="materi">
                                                    <option value="" class="text-center">-- Pilih --</option>
                                                    <option value="Kuliah Pengayaan">Kuliah Pengayaan</option>
                                                    <option value="Mini C-Ex">Mini C-Ex</option>
                                                    <option value="RPS">RPS</option>
                                                    <option value="CRS">CRS</option>
                                                    <option value="CSS">CSS</option>
                                                    <option value="OSLER">OSLER</option>
                                                    <option value="DPS">DPS</option>
                                                    <option value="BST">BST</option>
                                                </select>
                                                <div id="err_materi" class="err i text-danger text-center text-xs blink mb-2"></div>

                                                <label for="tgl">Tanggal</label>
                                                <input class="form-control" type="date" id="tgl" name="tgl">
                                                <div id="err_tgl" class="err i text-danger text-center text-xs blink mb-2"></div>

                                                <label for="topik">Topik</label>
                                                <textarea class="form-control" id="topik" name="topik" rows="3"></textarea>
                                                <div id="err_topik" class="err i text-danger text-center text-xs blink mb-2"></div>

                                                <label for="lk">LK</label>
                                                <input class="form-control" id="lk" name="lk">
                                                <div id="err_lk" class="err i text-danger text-center text-xs blink mb-2"></div>

                                                <label for="dosen_pembimbing">Dosen Pembimbing</label>
                                                <input class="form-control" id="dosen_pembimbing" name="dosen_pembimbing">
                                                <div id="err_dosen_pembimbing" class="err i text-danger text-center text-xs blink mb-2"></div>
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
                    <div id="data_materi"></div>
                </div>

                <script>
                    $(document).ready(function() {
                        $('#data_materi')
                            .load(
                                "_admin/view/v_ked_coass_materi_data.php?idpr=<?= $_GET['data'] ?>");
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
                        var materi = $("#materi").val();
                        var tgl = $("#tgl").val();
                        var topik = $("#topik").val();
                        var lk = $("#lk").val();
                        var dosen_pembimbing = $("#dosen_pembimbing").val();
                        if (
                            materi == "" ||
                            tgl == "" ||
                            topik == "" ||
                            lk == "" ||
                            dosen_pembimbing == ""
                        ) {
                            simpan_tidaksesuai();
                            materi == "" ? $("#err_materi").html("Pilih Materi") : $("#err_materi").html("");
                            tgl == "" ? $("#err_tgl").html("Pilih Tanggal") : $("#err_tgl").html("")
                            topik == "" ? $("#err_topik").html("Isikan Topik") : $("#err_topik").html("")
                            lk == "" ? $("#err_lk").html("Isikan lk") : $("#err_lk").html("")
                            dosen_pembimbing == "" ? $("#err_dosen_pembimbing").html("Isikan Dosen Pembimbing") : ("#err_dosen_pembimbing").html("")
                        } else {
                            $.ajax({
                                type: 'POST',
                                url: "_admin/exc/x_v_ked_coass_materi_input_t.php",
                                data: data_form,
                                dataType: "JSON",
                                success: function(response) {
                                    if (response.ket == "SUCCESS") {
                                        $('#modal_tambah').modal('hide')
                                        simpan_berhasil("");
                                        loading_sw2();
                                        $('#data_materi')
                                            .load(
                                                "_admin/view/v_ked_coass_materi_data.php?idpr=<?= $_GET['data'] ?>");
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