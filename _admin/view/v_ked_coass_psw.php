    <div class="container-fluid">
        <?php
        try {
            $sql_bimbingan = "SELECT * FROM tb_praktikan ";
            $sql_bimbingan .= " JOIN tb_pembimbing_pilih ON tb_praktikan.id_praktikan = tb_pembimbing_pilih.id_praktikan";
            $sql_bimbingan .= " JOIN tb_praktik ON tb_praktikan.id_praktik = tb_praktik.id_praktik";
            $sql_bimbingan .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
            $sql_bimbingan .= " WHERE tb_pembimbing_pilih.id_pembimbing = " . $d_pembimbing['id_pembimbing'];
            $sql_bimbingan .= " AND status_praktik = 'Y'";
            $sql_bimbingan .= " ORDER BY tb_praktik.id_praktik ASC";
            // echo "$sql_bimbingan<br>";
            $q_bimbingan = $conn->query($sql_bimbingan);
            $r_bimbingan = $q_bimbingan->rowCount();
        } catch (PDOException $ex) {
            echo "<script>alert('DATA BIMBINGAN PRAKTIKAN');";
            echo "document.location.href='?error404';</script>";
        }
        ?>
        <?php if ($r_bimbingan > 0) { ?>
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-light b text-uppercase">
                    Daftar Praktikan (Pembuatan Status Wajib)
                </div>
                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Institusi</th>
                                    <th scope="col">Kelompok/Gelombang</th>
                                    <th scope="col">Nama Praktikan</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($d_bimbingan = $q_bimbingan->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr class="text-center">
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $d_bimbingan['nama_institusi']; ?></td>
                                        <td><?= $d_bimbingan['nama_praktik']; ?></td>
                                        <td><?= $d_bimbingan['nama_praktikan']; ?></td>
                                        <td class=" text-center">
                                            <?php
                                            try {
                                                $sql_psw = "SELECT * FROM tb_logbook_ked_coass_psw ";
                                                $sql_psw .= " WHERE id_praktikan = " . $d_bimbingan['id_praktikan'];
                                                // echo "$sql_psw<br>";
                                                $q_psw = $conn->query($sql_psw);
                                                $r_psw = $q_psw->rowCount();
                                            } catch (PDOException $ex) {
                                                echo "<script>alert('$ex');</script>";
                                                echo "<script>document.location.href='?error404';</script>";
                                            }
                                            ?>
                                            <?php if ($r_psw > 0) { ?>
                                                <a class="btn btn-outline-info btn-sm col" href="#" data-toggle="modal" data-target="#modal_data_psw<?= $no ?>">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                                <div class="modal" id="modal_data_psw<?= $no ?>" role="dialog" aria-labelledby="modal_data_psw<?= $no ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-xxl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-secondary text-light">
                                                                Pembuatan Status Wajib
                                                                <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close">
                                                                    X
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <?php
                                                                    try {
                                                                        $r_1 = $conn->query("SELECT * FROM tb_logbook_ked_coass_psw WHERE id_praktikan = " . $d_bimbingan['id_praktikan'] . " AND ruang = 'Rawat Inap'")->rowCount();
                                                                        $r_2 = $conn->query("SELECT * FROM tb_logbook_ked_coass_psw WHERE id_praktikan = " . $d_bimbingan['id_praktikan'] . " AND ruang = 'Rawat Jalan'")->rowCount();
                                                                        $r_3 = $conn->query("SELECT * FROM tb_logbook_ked_coass_psw WHERE id_praktikan = " . $d_bimbingan['id_praktikan'] . " AND ruang = 'Keswara'")->rowCount();
                                                                        $r_4 = $conn->query("SELECT * FROM tb_logbook_ked_coass_psw WHERE id_praktikan = " . $d_bimbingan['id_praktikan'] . " AND ruang = 'Napza'")->rowCount();
                                                                        $r_5 = $conn->query("SELECT * FROM tb_logbook_ked_coass_psw WHERE id_praktikan = " . $d_bimbingan['id_praktikan'] . " AND ruang = 'Psikogeriatri'")->rowCount();
                                                                        $r_6 = $conn->query("SELECT * FROM tb_logbook_ked_coass_psw WHERE id_praktikan = " . $d_bimbingan['id_praktikan'] . " AND ruang = 'IGD'")->rowCount();
                                                                    } catch (PDOException $ex) {
                                                                    ?>
                                                                        <script>
                                                                            alert("<?= $ex->getMessage() . $ex->getLine() ?>");
                                                                            document.location.href = '?error404';
                                                                        </script>";
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <div class="col-md">
                                                                        Rawat Inap : <?= $r_1 > 0 ? "<i class='fa-solid fa-circle-check text-success'></i>" : "<i class='fa-solid fa-circle-xmark text-danger'></i>" ?><br>
                                                                        Rawat Jalan : <?= $r_2 > 0 ? "<i class='fa-solid fa-circle-check text-success'></i>" : "<i class='fa-solid fa-circle-xmark text-danger'></i>" ?><br>
                                                                        Keswara : <?= $r_3 > 0 ? "<i class='fa-solid fa-circle-check text-success'></i>" : "<i class='fa-solid fa-circle-xmark text-danger'></i>" ?><br>
                                                                    </div>
                                                                    <div class="col-md my-auto">
                                                                        Napza : <?= $r_4 > 0 ? "<i class='fa-solid fa-circle-check text-success'></i>" : "<i class='fa-solid fa-circle-xmark text-danger'></i>" ?><br>
                                                                        Psikogeriatri : <?= $r_5 > 0 ? "<i class='fa-solid fa-circle-check text-success'></i>" : "<i class='fa-solid fa-circle-xmark text-danger'></i>" ?><br>
                                                                        IGD : <?= $r_6 > 0 ? "<i class='fa-solid fa-circle-check text-success'></i>" : "<i class='fa-solid fa-circle-xmark text-danger'></i>" ?><br>
                                                                    </div>
                                                                </div>
                                                                <hr class="border-1">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered" id="dataTable<?= $no; ?>">
                                                                        <thead class="table-dark">
                                                                            <tr class="text-center">
                                                                                <th scope='col'>No</th>
                                                                                <th>Ruang</th>
                                                                                <th>Nama</th>
                                                                                <th>Usia</th>
                                                                                <th>DD</th>
                                                                                <th>Diagnosis Kerja</th>
                                                                                <th>Terapi</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $no0 = 1;
                                                                            while ($d_psw = $q_psw->fetch(PDO::FETCH_ASSOC)) {
                                                                            ?>
                                                                                <tr>
                                                                                    <td class="text-center"><?= $no0; ?></td>
                                                                                    <td><?= $d_psw['ruang']; ?></td>
                                                                                    <td><?= $d_psw['nama']; ?></td>
                                                                                    <td><?= $d_psw['usia']; ?></td>
                                                                                    <td><?= $d_psw['dd']; ?></td>
                                                                                    <td><?= $d_psw['diagnosis_kerja']; ?></td>
                                                                                    <td><?= $d_psw['terapi']; ?></td>
                                                                                </tr>
                                                                            <?php
                                                                                $no0++;
                                                                            }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <script>
                                                                $(document).ready(function() {
                                                                    $("#dataTable<?= $no ?>").DataTable();
                                                                });
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <span class='badge badge-secondary'>Data Belum Ada</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-outline-info btn-sm" href="?ked_coass_elogbook=psw&data=<?= encryptString($d_bimbingan['id_praktikan'], $customkey) ?>">
                                                Tamba/Ubah
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="jumbotron border-2 shadow">
                <div class="jumbotron-fluid">
                    <div class="text-gray-700">
                        <h5 class="text-center">Data Praktikan Tidak Ada</h5>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>