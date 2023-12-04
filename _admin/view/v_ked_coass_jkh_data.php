    <?php

    include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
    // error_reporting(0);
    $idpr = decryptString($_GET['idpr'], $customkey);
    try {
        $sql_jkh = "SELECT * FROM tb_logbook_ked_coass_jkh ";
        $sql_jkh .= " WHERE id_praktikan = " . $idpr;
        $sql_jkh .= " ORDER BY tgl_ubah DESC, tgl_tambah DESC";
        // echo "$sql_jkh<br>";
        $q_jkh = $conn->query($sql_jkh);
        $r_jkh = $q_jkh->rowCount();
    } catch (PDOException $ex) {
        echo "<script>alert('ERROR DATA JADWAL KEGIATAN HARIAN INPUT');</script>";
        echo "<script>document.location.href='?error404';</script>";
    }
    ?>
    <?php if ($r_jkh > 0) { ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered " id="dataTable">
                <thead class="">
                    <tr class="text-center">
                        <th scope='col'>No</th>
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                        <th>Topik</th>
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
                            <td><?= tanggal($d_jkh['tgl']); ?></td>
                            <td><?= $d_jkh['kegiatan']; ?></td>
                            <td><?= $d_jkh['topik']; ?></td>
                            <td class="text-center">
                                <a href="#" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#modal_ubah<?= $no0; ?>">
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
                                                    <label for="tgl<?= $no0 ?>">Tanggal</label>
                                                    <input type="date" class="form-control" id="tgl<?= $no0 ?>" name="tgl" value="<?= $d_jkh['tgl'] ?>">
                                                    <div id="err_tgl<?= $no0 ?>" class="i text-danger text-center text-xs blink  mb-2"></div>
                                                    <label for="kegiatan<?= $no0 ?>">Kegiatan</label>
                                                    <textarea id="kegiatan<?= $no0 ?>" name="kegiatan" class="form-control " rows="3"><?= $d_jkh['kegiatan'] ?></textarea>
                                                    <div id="err_kegiatan<?= $no0 ?>" class="i text-danger text-center text-xs blink  mb-2"></div>
                                                    <label for="topik<?= $no0 ?>">Topik</label>
                                                    <textarea id="topik<?= $no0 ?>" name="topik" class="form-control" rows="3"><?= $d_jkh['topik'] ?></textarea>
                                                    <div id="err_topik<?= $no0 ?>" class="i text-danger text-center text-xs blink"></div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <a onClick="ubah('<?= $no0; ?>', '<?= encryptString($d_jkh['id'], $customkey) ?>' );" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Ubah</a>
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
            function ubah(x, y) {
                var data_form = $('#form_u' + x).serializeArray();
                data_form.push({
                    name: "id",
                    value: y
                });
                var tgl = $("#tgl" + x).val();
                var kegiatan = $("#kegiatan" + x).val();
                var topik = $("#topik" + x).val();

                if (
                    tgl == "" ||
                    kegiatan == "" ||
                    topik == ""
                ) {
                    simpan_tidaksesuai();
                    if (tgl == "") {
                        $('#tgl' + x).attr('class', 'border-danger border-2  form-control');
                        $("#err_tgl" + x).html("Pilih Tanggal");
                    } else {
                        $('#tgl' + x).attr('class', 'form-control');
                        $("#err_tgl" + x).html("");
                    }

                    if (kegiatan == "") {
                        $('#kegiatan' + x).attr('class', 'border-danger border-2 form-control');
                        $("#err_kegiatan" + x).html("Isikan Kegiatan");
                    } else {
                        $('#kegiatan' + x).attr('class', 'form-control');
                        $("#err_kegiatan" + x).html("");
                    }

                    if (topik == "") {
                        $('#topik' + x).attr('class', 'border-danger border-2 form-control');
                        $("#err_topik" + x).html("Isikan Topik");
                    } else {
                        $('#topik' + x).attr('class', 'form-control');
                        $("#err_topik" + x).html("");
                    }
                } else {
                    $.ajax({
                        type: 'POST',
                        url: "_admin/exc/x_v_ked_coass_jkh_data_u.php",
                        data: data_form,
                        dataType: "json",
                        success: function(response) {
                            if (response.ket == "SUCCESS") {
                                // console.log('<?= $no0; ?>');
                                console.log(response.cok);
                                $('#modal_ubah' + x).modal('hide');
                                ubah_berhasil();
                                loading_sw2();
                                $('#data_jkh')
                                    .load(
                                        "_admin/view/v_ked_coass_jkh_data.php?idpr=<?= $_GET['idpr'] ?>");
                            } else simpan_gagal_database();
                            console.log(response);
                        },
                        error: function(response) {
                            error();
                            console.log(response.cek);

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
                            url: "_admin/exc/x_v_ked_coass_jkh_data_h.php",
                            data: {
                                id: $(this).attr('id')
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.ket == "SUCCESS") {
                                    hapus_berhasil("");
                                    loading_sw2();
                                    $('#data_jkh')
                                        .load(
                                            "_admin/view/v_ked_coass_jkh_data.php?idpr=<?= $_GET['idpr'] ?>");
                                } else simpan_gagal_database();
                            },
                            error: function() {
                                error();
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
            $('#dataTable').DataTable();
        });
    </script>