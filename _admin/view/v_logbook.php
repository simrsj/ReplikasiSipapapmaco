<?php if (isset($_GET['logbook']) && $d_prvl['r_logbook'] == 'Y') { ?>
    <div class="container-fluid">
        <div class="h3 mb-2 text-gray-800 row ">
            <div class="col-lg-2">Log Book</div>
            <div class="col-lg-10 my-auto">
                <hr>
            </div>
        </div>
        <div class="card shadow mb-4 card-body">
            <?php
            try {
                $sql = "SELECT * FROM tb_praktik ";
                $sql .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi ";
                $sql .= " WHERE status_praktik = 'Y' ";
                if ($d_prvl['level_user'] == 2) {
                    $sql .= " AND  tb_institusi.id_institusi = " . $d_prvl['id_institusi'];
                }
                $sql .= " ORDER BY tb_praktik.id_praktik DESC";
                $q = $conn->query($sql);
            } catch (Exception $ex) {
            ?>
                <script>
                    alert('<?= $e->getMessage() ?>');
                    document.location.href = '?error404';
                </script>";
            <?php
            }
            $r = $q->rowCount();
            ?>
            <?php if ($r > 0) { ?>
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Institusi Pendidikan</th>
                                <th scope="col">Nama Kelompok/Gelombang</th>
                                <th scope="col">Periode Mulai <br> (YYYY-MM-DD)</th>
                                <th scope="col">Periode Selesai <br> (YYYY-MM-DD)</th>
                                <th scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php while ($d = $q->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td><?= $d['nama_institusi']; ?></td>
                                    <td><?= $d['nama_praktik']; ?></td>
                                    <td><?= $d['tgl_mulai_praktik']; ?></td>
                                    <td><?= $d['tgl_selesai_praktik']; ?></td>
                                    <td class="text-center">
                                        <a href="?logbook&data=<?= encryptString($d['id_praktik'], $customkey) ?>" class="btn btn-outline-info" title="Detail Info Log Book">
                                            <i class="fas fa-info-circle"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div class="jumbotron">
                    <div class="jumbotron-fluid">
                        <div class="text-gray-700">
                            <h5 class="text-center">Data Log Book Tidak Ada</h5>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } else { ?>
    <script>
        alert('Maaf anda tidak punya hak akses');
        document.location.href = '?error401';
    </script>";
<?php } ?>