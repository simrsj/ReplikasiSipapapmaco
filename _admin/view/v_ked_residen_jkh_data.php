    <?php

    include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
    // error_reporting(0);
    $idpr = decryptString($_GET['idpr'], $customkey);
    try {
        $sql_jkh = "SELECT * FROM tb_logbook_ked_residen_jkh ";
        $sql_jkh .= " WHERE id_praktikan = " . $idpr;
        $sql_jkh .= " ORDER BY tgl_ubah DESC, tgl_tambah DESC";
        // echo "$sql_jkh<br>";
        $q_jkh = $conn->query($sql_jkh);
        $r_jkh = $q_jkh->rowCount();
    } catch (PDOException $ex) {
    ?>
        <script>
            alert("<?= $ex->getMessage() . $ex->getLine() ?>");
            document.location.href = '?error404';
        </script>
    <?php
    }
    ?>
    <?php if ($r_jkh > 0) { ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered " id="dataTable">
                <thead class="">
                    <tr class="text-center">
                        <th scope='col'>No&nbsp;&nbsp;</th>
                        <th>Tanggal<br>(yyyy-mm-dd)&nbsp;&nbsp;</th>
                        <th>Visite Besar&nbsp;&nbsp;</th>
                        <th>Rapat Klinik&nbsp;&nbsp;</th>
                        <th>Acara Ilmiah&nbsp;&nbsp;</th>
                        <th>Mata Kuliah/Dosen&nbsp;&nbsp;</th>
                        <th>Pasien Rajal&nbsp;&nbsp;</th>
                        <th>Pasien Ranap&nbsp;&nbsp;</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no0 = 1;
                    while ($d_jkh = $q_jkh->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td class="text-center"><?= $no0; ?></td>
                            <td><?= $d_jkh['tgl']; ?></td>
                            <td><?= $d_jkh['visite_besar'] == "Y" ? '<div class="text-success text-center text-lg"><i class="fa-solid fa-check"></i></div>' : ''; ?></td>
                            <td><?= $d_jkh['rapat_klinik'] == "Y" ? '<div class="text-success text-center text-lg"><i class="fa-solid fa-check"></i></div>' : ''; ?></td>
                            <td><?= $d_jkh['acara_ilmiah']; ?></td>
                            <td><?= $d_jkh['matkul_dosen']; ?></td>
                            <td><?= $d_jkh['j_pasien_rajal']; ?></td>
                            <td><?= $d_jkh['j_pasien_ranap']; ?></td>
                            <td class="text-center">
                                <a href="#" class="btn btn-primary btn-sm ubah_init" data-toggle="modal" data-target="#modal_ubah<?= $no0; ?>">
                                    <i class=" fa fa-edit"></i> Ubah
                                </a>

                                <div class="modal" id="modal_ubah<?= $no0; ?>" tabindex="-1" role="dialog" aria-labelledby="modal_ubah<?= $no0; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-light">
                                                Ubah Jadwal Kegiatan Harian
                                                <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close">
                                                    X
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form id="form_u<?= $no0 ?>" method="post">
                                                    <label for="tgl<?= $no0 ?>">Tanggal <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="tgl<?= $no0 ?>" name="tgl" value="<?= $d_jkh['tgl'] ?>">
                                                    <div id="err_tgl<?= $no0 ?>" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    <div class="row  mb-2 text-center">
                                                        <div class="col-xl">
                                                            <label for="visite_besar<?= $no0 ?>">Visite Besar</label>
                                                            <input type="checkbox" id="visite_besar<?= $no0 ?>" name="visite_besar" class="" value="Y" <?= $d_jkh['visite_besar'] == "Y" ? "checked" : "" ?>>
                                                            <!-- <div id="err_visite_besar<?= $no0 ?>" class="i err text-danger text-center text-xs blink mb-2"></div> -->
                                                        </div>
                                                        <div class="col-xl text-center">
                                                            <label for="rapat_klinik<?= $no0 ?>">Rapat Klinik</label>
                                                            <input type="checkbox" id="rapat_klinik<?= $no0 ?>" name="rapat_klinik" class="" value="Y" <?= $d_jkh['rapat_klinik'] == "Y" ? "checked" : "" ?>>
                                                            <!-- <div id="err_rapat_klinik<?= $no0 ?>" class="i err text-danger text-center text-xs blink mb-2"></div> -->
                                                        </div>
                                                    </div>
                                                    <label for="acara_ilmiah<?= $no0 ?>">Acara Ilmiah<span class="text-danger">*</span></label>
                                                    <textarea id="acara_ilmiah<?= $no0 ?>" name="acara_ilmiah" class="form-control" rows="2"><?= $d_jkh['acara_ilmiah'] ?></textarea>
                                                    <div id="err_acara_ilmiah<?= $no0 ?>" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    <label for="matkul_dosen<?= $no0 ?>">Mata Kuliah/Dosen<span class="text-danger">*</span></label>
                                                    <textarea id="matkul_dosen<?= $no0 ?>" name="matkul_dosen" class="form-control" rows="2"><?= $d_jkh['matkul_dosen'] ?></textarea>
                                                    <div id="err_matkul_dosen<?= $no0 ?>" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    <div class="row">
                                                        <div class="col-xl">
                                                            <label for="j_pasien_rajal<?= $no0 ?>">Pasien Rajal<span class="text-danger">*</span></label>
                                                            <input type="number" min=0 id="j_pasien_rajal<?= $no0 ?>" name="j_pasien_rajal" class="form-control" value="<?= $d_jkh['j_pasien_rajal'] ?>">
                                                            <div id="err_j_pasien_rajal<?= $no0 ?>" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                        </div>
                                                        <div class="col-xl">
                                                            <label for="j_pasien_ranap<?= $no0 ?>">Pasien Ranap<span class="text-danger">*</span></label>
                                                            <input type="number" min=0 id="j_pasien_ranap<?= $no0 ?>" name="j_pasien_ranap" class="form-control" value="<?= $d_jkh['j_pasien_ranap'] ?>"></input>
                                                            <div id="err_j_pasien_ranap<?= $no0 ?>" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <a onClick="ubah('<?= $no0; ?>', '<?= encryptString($d_jkh['id'], $customkey) ?>' )" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Ubah</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-danger btn-sm hapus" id="<?= encryptString($d_jkh['id'], $customkey) ?>">
                                    <i class="fa fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php
                        $no0++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <script>
            $(".ubah_init").click(function() {
                $(".err").html("");
            });

            function ubah(x, y) {
                var data_form = $('#form_u' + x).serializeArray();
                data_form.push({
                    name: "id",
                    value: y
                });
                var tgl = $("#tgl" + x).val();
                // var visite_besar = $("#visite_besar").val();
                // var rapat_klinik = $("#rapat_klinik").val();
                var acara_ilmiah = $("#acara_ilmiah" + x).val();
                var matkul_dosen = $("#matkul_dosen" + x).val();
                var j_pasien_rajal = $("#j_pasien_rajal" + x).val();
                var j_pasien_ranap = $("#j_pasien_ranap" + x).val();
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
                    (tgl == "") ? $("#err_tgl" + x).html("Pilih Tanggal"): $("#err_tgl").html("");
                    // (visite_besar == "") ? $("#err_visite_besar" + x).html("Isi Visite Besar"): $("#err_visite_besar").html("");
                    // (rapat_klinik == "") ? $("#err_rapat_klinik" + x).html("Pilih Rapat Klinik"): $("#err_rapat_klinik").html("");
                    (acara_ilmiah == "") ? $("#err_acara_ilmiah" + x).html("Harus Diisi"): $("#err_acara_ilmiah").html("");
                    (matkul_dosen == "") ? $("#err_matkul_dosen" + x).html("Harus Diisi"): $("#err_matkul_dosen").html("");
                    (j_pasien_rajal == "" || j_pasien_rajal < 0) ? $("#err_j_pasien_rajal" + x).html("Isian harus lebih sama dengan 0 (Nol)"): $("#err_j_pasien_rajal" + x).html("");
                    (j_pasien_ranap == "" || j_pasien_ranap < 0) ? $("#err_j_pasien_ranap" + x).html("Isian harus lebih sama dengan 0 (Nol)"): $("#err_j_pasien_ranap" + x).html("");
                }
                //eksekusi query ubah
                else {
                    $.ajax({
                        type: 'POST',
                        url: "_admin/exc/x_v_ked_residen_jkh_data_u.php",
                        data: data_form,
                        dataType: "json",
                        success: function(response) {
                            if (response.ket == "SUCCESS") {
                                // console.log('<?= $no0; ?>');
                                console.log(response.cok);
                                $('#modal_ubah' + x).modal('hide');
                                custom_alert(true, 'success', '<center>DATA BERHASIL DIUBAH</center>', 10000);
                                loading_sw2();
                                $('#data_jkh')
                                    .load(
                                        "_admin/view/v_ked_residen_jkh_data.php?idpr=<?= $_GET['idpr'] ?>");
                            } else custom_alert(true, 'error', '<center>DATA GAGAL DIUBAH <br>' + response.ket + '</center>', 10000);
                        },
                        error: function(response) {
                            custom_alert(true, 'error', '<center>DATA ERROR <br>' + response.ket + '</center>', 10000);
                        }
                    });
                }
            }

            $(document).on('click', '.hapus', function() {
                Swal.fire({
                    title: 'Anda Yakin?',
                    text: "Data akan Permanen Terhapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e74a3b',
                    cancelButtonColor: '#858796',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Kembali'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'POST',
                            url: "_admin/exc/x_v_ked_residen_jkh_data_h.php",
                            data: {
                                id: $(this).attr('id')
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.ket == "SUCCESS") {
                                    custom_alert(true, 'success', '<center>DATA BERHASIL DIHAPUS</center>', 10000);
                                    loading_sw2();
                                    $('#data_jkh')
                                        .load(
                                            "_admin/view/v_ked_residen_jkh_data.php?idpr=<?= $_GET['idpr'] ?>");
                                } else custom_alert(true, 'error', '<center>DATA GAGAL DIUBAH <br>' + response.ket + '</center>', 10000);
                            },
                            error: function(response) {
                                custom_alert(true, 'error', '<center>DATA ERROR <br>' + response.ket + '</center>', 10000);
                            }
                        });
                    }
                })
            });
        </script>
    <?php } else { ?>
        <div class="jumbotron border-2 m-2 shadow">
            <div class="jumbotron-fluid">
                <div class="text-gray-700">
                    <h5 class="text-center">Data Tidak Ada</h5>
                </div>
            </div>
        </div>
    <?php } ?>

    <script>
        $(document).ready(function() {
            Swal.close();
            $('#dataTable').DataTable({
                'columnDefs': [{
                    'targets': [8],
                    /* column index */
                    'orderable': false,
                    /* true or false */
                }]
            });
        });
    </script>