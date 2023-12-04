<div class="table-responsive">
    <table class="table table-striped table-bordered" id="dataTable">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col" class="text-left">No&nbsp;&nbsp;</th>
                <th scope="col">Nama Praktikan&nbsp;&nbsp;</th>
                <th scope="col">ID Praktikan&nbsp;&nbsp;</th>
                <th scope="col">Kegiatan Harian&nbsp;&nbsp;</th>
                <th scope="col">Pencapaian Kompetensi Dasar&nbsp;&nbsp;</th>
                <th scope="col">Presentasi Ilmiah&nbsp;&nbsp;</th>
                <th scope="col">e-Log Book&nbsp;&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php while ($d_praktikan = $q_praktikan->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <th scope="row"><?= $no; ?></th>
                    <td><?= $d_praktikan['nama_praktikan']; ?></td>
                    <td><?= $d_praktikan['no_id_praktikan']; ?></td>

                    <!-- JKH -->
                    <td class="text-center">
                        <?php
                        try {
                            $sql_jkh = "SELECT * FROM tb_logbook_ked_residen_jkh ";
                            $sql_jkh .= " WHERE id_praktikan = " . $d_praktikan['id_praktikan'];
                            // echo $sql_jkh;
                            $q_jkh  = $conn->query($sql_jkh);
                            $r_jkh  = $q_jkh->rowCount();
                        } catch (Exception $ex) {
                        ?>
                            <script>
                                alert("<?= $ex->getMessage() . $ex->getLine() ?>");
                                document.location.href = '?error404';
                            </script>
                        <?php
                        }
                        ?>
                        <?php if ($r_jkh > 0) { ?>
                            <a class="btn btn-outline-info " href="#" data-toggle="modal" data-target="#m_jkh_<?= $no; ?>" title="Detail Jadwal Kegiatan Harian (JKH)">
                                <i class="fas fa-eye"></i>
                            </a>
                            <div class="modal" id="m_jkh_<?= $no; ?>" style="display: none;">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-secondary text-light">
                                            Jadwal Kegiatan Harian
                                            <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close">
                                                X
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped table-bordered " id="dataTable_jkh<?= $no; ?>">
                                                <thead class="table-dark">
                                                    <tr class="text-center">
                                                        <th scope='col'>No</th>
                                                        <th>
                                                            Semester
                                                            <hr class="m-0 p-0">
                                                            Stase
                                                        </th>
                                                        <th>Tanggal</th>
                                                        <th>Visite Besar</th>
                                                        <th>Rapat Klinik</th>
                                                        <th>Acara Ilmiah</th>
                                                        <th>Mata Kuliah / Dosen</th>
                                                        <th>Jumlah Pasien Rajal</th>
                                                        <th>Jumlah Pasien Ranap</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no0 = 1;
                                                    while ($d_jkh = $q_jkh->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?= $no0; ?></td>
                                                            <td>
                                                                <?= $d_jkh['semester']; ?>
                                                                <hr class="m-0 p-0">
                                                                <?= $d_jkh['stase']; ?>
                                                            </td>
                                                            <td><?= tanggal($d_jkh['tgl']); ?></td>
                                                            <td><?= $d_jkh['visite_besar']; ?></td>
                                                            <td><?= $d_jkh['rapat_klinik']; ?></td>
                                                            <td><?= $d_jkh['acara_ilmiah']; ?></td>
                                                            <td><?= $d_jkh['matkul_dosen']; ?></td>
                                                            <td><?= $d_jkh['j_pasien_rajal']; ?></td>
                                                            <td><?= $d_jkh['j_pasien_rajal']; ?></td>
                                                        </tr>
                                                    <?php
                                                        $no0++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $("#dataTable_jkh<?= $no ?>").DataTable();
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <a href="?logbook&ked_residen_jkh&data=<?= encryptString($d_praktikan['id_praktikan'], $customkey) ?>&admin=<?= $_GET['data'] ?>" class="btn btn-outline-primary" title="Ubah Jadwal Kegiatan Harian">
                            <i class="fa-solid fa-pen-to-square "></i>
                        </a>
                    </td>

                    <!-- PKD -->
                    <td class="text-center">
                        <?php
                        try {
                            $sql_pkd = "SELECT * FROM tb_logbook_ked_residen_pkd ";
                            $sql_pkd .= " WHERE id_praktikan = " . $d_praktikan['id_praktikan'];
                            // echo $sql_pkd;
                            $q_pkd  = $conn->query($sql_pkd);
                            $r_pkd  = $q_pkd->rowCount();
                        } catch (Exception $ex) {
                        ?>
                            <script>
                                alert("<?= $ex->getMessage() . $ex->getLine() ?>");
                                document.location.href = '?error404';
                            </script>
                        <?php
                        }
                        ?>
                        <?php if ($r_pkd > 0) { ?>
                            <a class="btn btn-outline-info " href="#" data-toggle="modal" data-target="#m_pkd_<?= $no; ?>" title="Detail Pencapaian Kompetensi Dasar (PKD)">
                                <i class="fas fa-eye"></i>
                            </a>
                            <div class="modal" id="m_pkd_<?= $no; ?>" style="display: none;">
                                <div class="modal-dialog modal-dialog-scrollable modal-xxl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-secondary text-light">
                                            Pencapaian Kompetensi Dasar
                                            <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close">
                                                X
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped table-bordered " id="dataTable_pkd<?= $no; ?>">
                                                <thead class="table-dark">
                                                    <tr class="text-center">
                                                        <th scope='col'>No&nbsp;&nbsp;</th>
                                                        <th>Jenis&nbsp;&nbsp;</th>
                                                        <th>Tanggal&nbsp;&nbsp;</th>
                                                        <th>Semester&nbsp;&nbsp;</th>
                                                        <th>No. RM&nbsp;&nbsp;</th>
                                                        <th>Inisial&nbsp;&nbsp;</th>
                                                        <th>ICD-10/Diagnosis&nbsp;&nbsp;</th>
                                                        <th>Th Farmakologis/Manajemen/Sesi ECT/Teknik Psi Suportif/Manajemen/Metode&nbsp;&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no0 = 1;
                                                    while ($d_pkd = $q_pkd->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?= $no0; ?></td>
                                                            <td><?= $d_pkd['jenis']; ?></td>
                                                            <td><?= tanggal($d_pkd['tgl']); ?></td>
                                                            <td><?= $d_pkd['semester']; ?></td>
                                                            <td><?= $d_pkd['no_rm']; ?></td>
                                                            <td><?= $d_pkd['inisial']; ?></td>
                                                            <td><?= $d_pkd['icd10_diagnosis']; ?></td>
                                                            <td><?= $d_pkd['ket']; ?></td>
                                                        </tr>
                                                    <?php
                                                        $no0++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $("#dataTable_pkd<?= $no ?>").DataTable();
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <a href="?logbook&ked_residen_pkd&data=<?= encryptString($d_praktikan['id_praktikan'], $customkey) ?>&admin=<?= $_GET['data'] ?>" class="btn btn-outline-primary" title="Ubah Jadwal Kegiatan Harian">
                            <i class="fa-solid fa-pen-to-square "></i>
                        </a>
                    </td>

                    <!-- PI -->
                    <td class="text-center">
                        <?php
                        try {
                            $sql_pi = "SELECT * FROM tb_logbook_ked_residen_pi ";
                            $sql_pi .= " WHERE id_praktikan = " . $d_praktikan['id_praktikan'];
                            // echo $sql_pi;
                            $q_pi = $conn->query($sql_pi);
                            $r_pi  = $q_pi->rowCount();
                        } catch (Exception $ex) {
                        ?>
                            <script>
                                alert("<?= $ex->getMessage() . $ex->getLine() ?>");
                                document.location.href = '?error404';
                            </script>
                        <?php
                        }
                        ?>
                        <?php if ($r_pi > 0) { ?>
                            <a class="btn btn-outline-info " href="#" data-toggle="modal" data-target="#m_pi_<?= $no; ?>" title="Detail Pencapaian Kompetensi Dasar (PKD)">
                                <i class="fas fa-eye"></i>
                            </a>
                            <div class="modal" id="m_pi_<?= $no; ?>" style="display: none;">
                                <div class="modal-dialog modal-dialog-scrollable modal-xxl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-secondary text-light">
                                            Presentasi Ilmiah
                                            <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close">
                                                X
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped table-bordered " id="dataTable_pi<?= $no; ?>">
                                                <thead class="table-dark">
                                                    <tr class="text-center">
                                                        <th scope='col'>No&nbsp;&nbsp;</th>
                                                        <th>Tanggal&nbsp;&nbsp;</th>
                                                        <th>Semester&nbsp;&nbsp;</th>
                                                        <th>Judul&nbsp;&nbsp;</th>
                                                        <th>Bim 1&nbsp;&nbsp;</th>
                                                        <th>Bim 2&nbsp;&nbsp;</th>
                                                        <th>Bim 3&nbsp;&nbsp;</th>
                                                        <th>Present&nbsp;&nbsp;</th>
                                                        <th>Pembimbing&nbsp;&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no0 = 1;
                                                    while ($d_pi = $q_pi->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?= $no0; ?></td>
                                                            <td><?= tanggal($d_pkd['tgl']); ?></td>
                                                            <td><?= $d_pkd['semester']; ?></td>
                                                            <td><?= $d_pkd['jenis']; ?></td>
                                                            <td><?= $d_pkd['bim1']; ?></td>
                                                            <td><?= $d_pkd['bim2']; ?></td>
                                                            <td><?= $d_pkd['bim3']; ?></td>
                                                            <td><?= $d_pkd['present']; ?></td>
                                                            <td><?= $d_pkd['pembimbing']; ?></td>
                                                        </tr>
                                                    <?php
                                                        $no0++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $("#dataTable_pi<?= $no ?>").DataTable();
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <a href="?logbook&ked_residen_pi&data=<?= encryptString($d_praktikan['id_praktikan'], $customkey) ?>&admin=<?= $_GET['data'] ?>" class="btn btn-outline-primary" title="Ubah Jadwal Kegiatan Harian">
                            <i class="fa-solid fa-pen-to-square "></i>
                        </a>
                    </td>

                    <!-- Unduh, Unggah -->
                    <td class="text-center">
                        <a href="_print\p_logbook_ked_coass.php?data=<?= encryptString($d_praktikan['id_praktikan'], $customkey) ?>" class="btn m-1 btn-outline-danger btn-xs rounded" title="Unduh Log Book" download>
                            <i class="fa-solid fa-file-arrow-down"></i> Unduh
                        </a>

                        <a href="#" data-toggle="modal" data-target="#m_unggah_<?= $no ?>" class="btn m-1 btn-outline-warning btn-xs text-dark rounded" title="Unggah Log Book">
                            <i class="fa-solid fa-file-arrow-up"></i> Unggah
                        </a>

                        <div class="modal" id="m_unggah_<?= $no ?>" style="display: none;">
                            <div class="modal-dialog modal-dialog-scrollable modal-xxl" role="document">
                                <div class="modal-dialog modal-dialog-scrollable modal-xxl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body m-0 ">
                                            <form id="form_file_logbook<?= $no ?>" enctype="multipart/form-data" method="POST">
                                                Unggah File Log Book yang Sudah di Tanda Tangan : <span style="color:red">*</span><br>
                                                <div class="custom-file">
                                                    <label class="custom-file-label text-xs mt-1" for="file_logbook<?= $no ?>" id="labelfile_logbook<?= $no ?>">Pilih File</label>
                                                    <input type="file" class="custom-file-input" id="file_logbook<?= $no ?>" name="file_logbook" accept="application/pdf" required>
                                                    <span class='i text-xs'>Data unggah harus pdf, Ukuran maksimal 3 Mb</span><br>
                                                    <div class="text-xs font-italic text-danger blink" id="err_file_invoice"></div><br>
                                                    <script>
                                                        $('.custom-file-input').on('change', function() {
                                                            var fileName = $(this).val();
                                                            fileName = fileName.replace(/^.*[\\\/]/, '');
                                                            if (fileName == "") fileName = "Pilih File";
                                                            $('#labelfile_logbook<?= $no ?>').html(fileName);
                                                        })
                                                    </script>
                                                </div>
                                                <a onClick="unggah_file_logbook('<?= $no ?>', '<?= encryptString($d_pkd['id'], $customkey) ?>' );" class="btn btn-warning btn-sm">
                                                    <i class="fa-solid fa-file-arrow-up"></i> Unggah
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php $no++; ?>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    function ubah_file_logbook(x, y) {
        var data_form = $('#form_u' + x).serializeArray();
        data_form.push({
            name: "id",
            value: y
        });
        var materi = $("#materi" + x).val();
        if (
            materi == "" ||
            tgl == "" ||
            topik == "" ||
            lk == "" ||
            dosen_pembimbing == ""
        ) {
            simpan_tidaksesuai();
            materi == "" ? $("#err_materi" + x).html("Pilih Materi") : $("#err_materi" + x).html("");
            tgl == "" ? $("#err_tgl" + x).html("Pilih Tanggal") : $("#err_tgl" + x).html("");
            topik == "" ? $("#err_topik" + x).html("Isikan Topik") : $("#err_topik" + x).html("")
            lk == "" ? $("#err_lk" + x).html("Isikan LK") : $("#err_lk" + x).html("")
            dosen_pembimbing == "" ? $("#err_dosen_pembimbing" + x).html("Isikan Dosen Pembimbing") : $("#err_dosen_pembimbing" + x).html("")
        } else {
            loading_sw2();
            $.ajax({
                type: 'POST',
                url: "_admin/exc/x_v_ked_coass_materi_data_u.php",
                data: data_form,
                dataType: "JSON",
                success: function(response) {
                    if (response.ket == "SUCCESS") {
                        $('#modal_ubah' + x).modal('hide')
                        $('#data_materi')
                            .load(
                                "_admin/view/v_ked_coass_materi_data.php?idpr=<?= $_GET['idpr'] ?>");
                    } else simpan_gagal_database();
                },
                error: function(response) {
                    error();
                }
            });
        }
    }
</script>