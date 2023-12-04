    <?php

    include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
    // error_reporting(0);
    $idpr = decryptString($_GET['idpr'], $customkey);
    try {
        $sql_pkd = "SELECT * , tb_logbook_ked_residen_pkd.id as id_pkd  FROM tb_logbook_ked_residen_pkd ";
        $sql_pkd .= " JOIN tb_logbook_ked_residen_pkd_jenis ON tb_logbook_ked_residen_pkd.jenis = tb_logbook_ked_residen_pkd_jenis.id";
        $sql_pkd .= " WHERE id_praktikan = " . $idpr;
        $sql_pkd .= " ORDER BY tgl_ubah DESC, tgl_tambah DESC";
        // echo "$sql_pkd<br>";
        $q_pkd = $conn->query($sql_pkd);
        $r_pkd = $q_pkd->rowCount();
    } catch (PDOException $ex) {
    ?>
        <script>
            alert("<?= $ex->getMessage() . $ex->getLine() . $sql_pkd ?>");
            document.location.href = '?error404';
        </script>
    <?php
    }
    ?>
    <?php if ($r_pkd > 0) { ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered " id="dataTable">
                <thead class="">
                    <tr class="text-center">
                        <th scope='col'>No&nbsp;&nbsp;</th>
                        <th>Jenis&nbsp;&nbsp;</th>
                        <th>Tanggal<br>(yyyy-mm-dd)&nbsp;&nbsp;</th>
                        <th>Semester&nbsp;&nbsp;</th>
                        <th>No. RM&nbsp;&nbsp;</th>
                        <th>Inisial&nbsp;&nbsp;</th>
                        <th>ICD-10/Diagnosis&nbsp;&nbsp;</th>
                        <th>Th Farmakologis/Manajemen/Sesi ECT/Teknik Psi Suportif/Manajemen/Metode&nbsp;&nbsp;</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no0 = 1;
                    while ($d_pkd = $q_pkd->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td class="text-center"><?= $no0; ?></td>
                            <td><?= $d_pkd['nama']; ?></td>
                            <td><?= $d_pkd['tgl']; ?></td>
                            <td><?= $d_pkd['semester']; ?></td>
                            <td><?= $d_pkd['no_rm']; ?></td>
                            <td><?= $d_pkd['inisial']; ?></td>
                            <td><?= $d_pkd['icd10_diagnosis']; ?></td>
                            <td><?= $d_pkd['ket']; ?></td>
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
                                                    <label for="jenis">Jenis <span class="text-danger">*</span></label>
                                                    <div class="text-center">
                                                        <select class="select2-long<?= $no0 ?> text-center" id="jenis<?= $no0 ?>>" name="jenis">
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
                                                                <?= ($d_pkd['jenis'] == $d_jenis['id']) ? $selected = "selected" : $selected = ""; ?>
                                                                <option value="<?= $d_jenis['id'] ?>" <?= $selected ?>><?= $d_jenis['nama'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <script>
                                                            $(".select2-long<?= $no0 ?>").select2({
                                                                placeholder: "-------------- Pilih --------------",
                                                                allowClear: true,
                                                                width: "100%",
                                                            });
                                                        </script>
                                                    </div>
                                                    <div id="err_jenis<?= $no0 ?>" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    <label for="tgl<?= $no0 ?>">Tanggal <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="tgl<?= $no0 ?>" name="tgl" value="<?= $d_pkd['tgl'] ?>">
                                                    <div id="err_tgl<?= $no0 ?>" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    <div class="row mb-2 text-center">
                                                        <div class="col-xl">
                                                            <label for="semester<?= $no0 ?>">Semester<span class="text-danger">*</span></label>
                                                            <input type="number" min="0" id="semester<?= $no0 ?>" name="semester" class="form-control" value="<?= $d_pkd['semester'] ?>">
                                                            <div id="err_semester<?= $no0 ?>" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                        </div>
                                                        <div class="col-xl text-center">
                                                            <label for="no_rm<?= $no0 ?>">No. RM<span class="text-danger">*</span></label>
                                                            <input type="number" min="0" id="no_rm<?= $no0 ?>" name="no_rm" class="form-control" value="<?= $d_pkd['no_rm'] ?>">
                                                            <div id="err_no_rm<?= $no0 ?>" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                        </div>
                                                        <div class="col-xl text-center">
                                                            <label for="inisial<?= $no0 ?>">Inisial<span class="text-danger">*</span></label>
                                                            <input type="type" id="inisial<?= $no0 ?>" name="inisial" class="form-control" value="<?= $d_pkd['inisial'] ?>">
                                                            <div id="err_inisial<?= $no0 ?>" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                        </div>
                                                    </div>
                                                    <label for="icd10_diagnosis<?= $no0 ?>">ICD-10/Diagnosis<span class="text-danger">*</span></label>
                                                    <textarea id="icd10_diagnosis<?= $no0 ?>" name="icd10_diagnosis" class="form-control" rows="2"><?= $d_pkd['icd10_diagnosis'] ?></textarea>
                                                    <div id="err_icd10_diagnosis<?= $no0 ?>" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                    <label for="ket<?= $no0 ?>">Th Farmakologis/Manajemen/Sesi ECT/Teknik Psi Suportif/Manajemen/Metode<span class="text-danger">*</span></label>
                                                    <textarea id="ket<?= $no0 ?>" name="ket" class="form-control" rows="2"><?= $d_pkd['ket'] ?></textarea>
                                                    <div id="err_ket<?= $no0 ?>" class="i err text-danger text-center text-xs blink mb-2"></div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <a onClick="ubah('<?= $no0; ?>', '<?= encryptString($d_pkd['id_pkd'], $customkey) ?>' )" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Ubah</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-danger btn-sm hapus" id="<?= encryptString($d_pkd['id_pkd'], $customkey) ?>">
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
                var jenis = $("#jenis" + x).val();
                var tgl = $("#tgl" + x).val();
                var semester = $("#semester" + x).val();
                var no_rm = $("#no_rm" + x).val();
                var icd10_diagnosis = $("#icd10_diagnosis" + x).val();
                var ket = $("#ket" + x).val();
                if (
                    jenis == "" ||
                    semester == "" ||
                    tgl == "" ||
                    no_rm == "" ||
                    icd10_diagnosis == "" ||
                    ket == ""
                ) {
                    custom_alert(true, 'warning', '<center>DATA WAJIB ADA YANG BELUM TERISI/TIDAK SESUAI</center>', 10000);
                    (jenis == "") ? $("#err_jenis" + x).html("Harus Dipilih"): $("#err_jenis" + x).html("");
                    (tgl == "") ? $("#err_tgl" + x).html("Harus Dipilih" + x): $("#err_tgl").html("");
                    (semester == "" || semester < 0) ? $("#err_semester" + x).html("Isian harus lebih sama dengan 0 (Nol)"): $("#err_semester" + x).html("");
                    (no_rm == "" || no_rm < 0) ? $("#err_no_rm" + x).html("Isian harus lebih sama dengan 0 (Nol)"): $("#err_no_rm" + x).html("");
                    (icd10_diagnosis == "") ? $("#err_icd10_diagnosis" + x).html("Harus Diisi"): $("#err_icd10_diagnosis" + x).html("");
                    (ket == "") ? $("#err_ket" + x).html("Harus Diisi"): $("#err_ket" + x).html("");
                } else {
                    $.ajax({
                        type: 'POST',
                        url: "_admin/exc/x_v_ked_residen_pkd_data_u.php",
                        data: data_form,
                        dataType: "JSON",
                        success: function(response) {
                            if (response.ket == "SUCCESS") {
                                $('#modal_ubah' + x).modal('hide')
                                custom_alert(true, 'success', '<center>DATA BERHASIL DIUBAH</center>', 10000);
                                loading_sw2();
                                $('#data_pkd')
                                    .load(
                                        "_admin/view/v_ked_residen_pkd_data.php?idpr=<?= $_GET['idpr'] ?>");
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
                            url: "_admin/exc/x_v_ked_residen_pkd_data_h.php",
                            data: {
                                id: $(this).attr('id')
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.ket == "SUCCESS") {
                                    custom_alert(true, 'success', '<center>DATA BERHASIL DIHAPUS</center>', 10000);
                                    loading_sw2();
                                    $('#data_pkd')
                                        .load(
                                            "_admin/view/v_ked_residen_pkd_data.php?idpr=<?= $_GET['idpr'] ?>");
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