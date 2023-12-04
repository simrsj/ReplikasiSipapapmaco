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
        } catch (Exception $ex) {
            echo "<script>alert('DATA BIMBINGAN PRAKTIKAN');";
            echo "document.location.href='?error404';</script>";
        }
        ?>
        <?php if ($r_bimbingan > 0) { ?>
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-light b">
                    Daftar Praktikan (Pencapaian Komptensi Keterampilan/P3D)
                </div>
                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Institusi</th>
                                    <th scope="col">Nama Praktikan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Data P3D</th>
                                    <th scope="col">Isi Data P3D</th>
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
                                        <td><?= $d_bimbingan['nama_praktikan']; ?></td>
                                        <td>
                                            <?php
                                            try {
                                                $sql_pertanyaan = "SELECT * FROM tb_logbook_ked_coass_p3d ";
                                                $sql_pertanyaan .= " WHERE id_praktikan = " . $d_bimbingan['id_praktikan'];
                                                // echo "$sql_pertanyaan<br>";
                                                $q_pertanyaan = $conn->query($sql_pertanyaan);
                                                $r_pertanyaan = $q_pertanyaan->rowCount();
                                                echo $r_pertanyaan != NULL ? "<span class='badge badge-success'>Data Sudah Ada</span>" : "<span class='badge badge-secondary'>Data Belum Ada</span>";
                                            } catch (Exception $ex) {
                                            ?>
                                                <script>
                                                    alert("<?= $ex->getMessage() . $ex->getLine() ?>");
                                                    document.location.href = '?error404';
                                                </script>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class=" text-center">
                                            <?php if ($r_pertanyaan > 0) { ?>
                                                <a class="btn btn-outline-info btn-sm col" href="#" data-toggle="modal" data-target="#modal_data_p3d<?= $no ?>">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                                <!-- Logout Modal-->
                                                <div class="modal" id="modal_data_p3d<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="modal_data_p3d<?= $no ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-secondary text-light">
                                                                Pencapaian Komptensi Keterampilan P3D
                                                                <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close">
                                                                    X
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-striped table-bordered ">
                                                                    <thead class="table-dark">
                                                                        <tr class="text-center">
                                                                            <th scope='col'>No</th>
                                                                            <th>Nama Kompetensi</th>
                                                                            <th>I</th>
                                                                            <th>II</th>
                                                                            <th>III</th>
                                                                            <th>IV</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        try {
                                                                            $sql_pertanyaan = "SELECT * FROM tb_pertanyaan ";
                                                                            $sql_pertanyaan .= " WHERE kategori_pertanyaan = 'P3D'";
                                                                            // echo "$sql_pertanyaan<br>";
                                                                            $q_pertanyaan = $conn->query($sql_pertanyaan);
                                                                        } catch (Exception $ex) {
                                                                            // echo "<script>alert('DATA PRAKTIKAN');</script>";
                                                                            echo "<script>document.location.href='?error404';</script>";
                                                                        }
                                                                        $no0 = 1;
                                                                        while ($d_pertanyaan = $q_pertanyaan->fetch(PDO::FETCH_ASSOC)) {
                                                                        ?>
                                                                            <tr>
                                                                                <td class="text-center"><?= $no0; ?></td>
                                                                                <td><?= $d_pertanyaan['pertanyaan']; ?></td>
                                                                                <td>
                                                                                    <?php

                                                                                    try {
                                                                                        $sql_p3d = "SELECT * FROM tb_logbook_ked_coass_p3d ";
                                                                                        $sql_p3d .= " WHERE id_praktikan = " . $d_bimbingan['id_praktikan'];
                                                                                        $sql_p3d .= " AND id_pertanyaan = " . $d_pertanyaan['id'];
                                                                                        // echo "$sql_p3d<br>";
                                                                                        $q_p3d = $conn->query($sql_p3d);
                                                                                        $d_p3d = $q_p3d->fetch(PDO::FETCH_ASSOC);
                                                                                    } catch (Exception $ex) {
                                                                                        echo "<script>alert('DATA PRAKTIKAN');</script>";
                                                                                        echo "<script>document.location.href='?error404';</script>";
                                                                                    }
                                                                                    ?>
                                                                                    <?= $d_p3d['i'] == 'Y' ? '<i class="fa-solid fa-circle-check text-success"></i>' : '<i class="fa-solid fa-circle-xmark text-danger"></i>'; ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $d_p3d['ii'] == 'Y' ? '<i class="fa-solid fa-circle-check text-success"></i>' : '<i class="fa-solid fa-circle-xmark text-danger"></i>'; ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $d_p3d['iii'] == 'Y' ? '<i class="fa-solid fa-circle-check text-success"></i>' : '<i class="fa-solid fa-circle-xmark text-danger"></i>'; ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $d_p3d['iv'] == 'Y' ? '<i class="fa-solid fa-circle-check text-success"></i>' : '<i class="fa-solid fa-circle-xmark text-danger"></i>'; ?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php
                                                                            $no0++;
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <span class='badge badge-secondary'>Data Belum Ada</span>
                                            <?php } ?>
                                        </td>
                                        <td class=" text-center">
                                            <a class="btn btn-success btn-sm" href="?ked_coass_elogbook=p3d&u=<?= urlencode(encryptString($d_bimbingan['id_praktikan'], $customkey)) ?>">
                                                Pencapaian Komptensi Keterampilan P3D
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