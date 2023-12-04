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
                Daftar Praktikan (Lembar Penilaian Perilaku Profesional)
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Institusi</th>
                                <th scope="col">Nama Praktikan</th>
                                <th scope="col">Data</th>
                                <th scope="col">Isi Data</th>
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
                                    <td class=" text-center">
                                        <?php
                                        try {
                                            $sql_pertanyaan = "SELECT * FROM tb_logbook_ked_coass_lppp ";
                                            $sql_pertanyaan .= " WHERE id_praktikan = " . $d_bimbingan['id_praktikan'];
                                            // echo "$sql_pertanyaan<br>";
                                            $q_pertanyaan = $conn->query($sql_pertanyaan);
                                            $r_pertanyaan = $q_pertanyaan->rowCount();
                                        } catch (Exception $ex) {
                                            echo "<script>alert('DATA PRAKTIKAN');</script>";
                                            echo "<script>document.location.href='?error404';</script>";
                                        }
                                        ?>
                                        <?php if ($r_pertanyaan > 0) { ?>
                                            <a class="btn btn-outline-info btn-sm col" href="#" data-toggle="modal" data-target="#modal_data_lppp<?= $no ?>">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                            <div class="modal" id="modal_data_lppp<?= $no ?>" role="dialog" aria-labelledby="modal_data_lppp<?= $no ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-secondary text-light">
                                                            Lembar Penilaian Perilaku Profesional
                                                            <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close">
                                                                X
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-striped table-bordered ">
                                                                <thead class="table-dark">
                                                                    <tr class="text-center">
                                                                        <th scope='col'>No</th>
                                                                        <th>Aspek Penilaian</th>
                                                                        <th>Ket Skor <span class="badge badge-danger">1</span></th>
                                                                        <th>Ket Skor <span class="badge badge-warning">2</span></th>
                                                                        <th>Ket Skor <span class="badge badge-success">3</span></th>
                                                                        <th>SKOR</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    try {
                                                                        $sql_pertanyaan = "SELECT * FROM tb_logbook_ked_coass_lppp ";
                                                                        $sql_pertanyaan .= " JOIN tb_pertanyaan ON tb_logbook_ked_coass_lppp.id_pertanyaan = tb_pertanyaan.id";
                                                                        $sql_pertanyaan .= " WHERE kategori_pertanyaan = 'LPPP'";
                                                                        // echo "$sql_pertanyaan<br>";
                                                                        $q_pertanyaan = $conn->query($sql_pertanyaan);
                                                                    } catch (PDOException $ex) {
                                                                        echo "<script>alert('DATA PERTANYAAN');</script>";
                                                                        echo "<script>document.location.href='?error404';</script>";
                                                                    }
                                                                    $no0 = 1;
                                                                    while ($d_pertanyaan = $q_pertanyaan->fetch(PDO::FETCH_ASSOC)) {
                                                                    ?>
                                                                        <tr>
                                                                            <td class="text-center"><?= $no0; ?></td>
                                                                            <td><?= $d_pertanyaan['pertanyaan']; ?></td>
                                                                            <td><?= $d_pertanyaan['p1']; ?></td>
                                                                            <td><?= $d_pertanyaan['p2']; ?></td>
                                                                            <td><?= $d_pertanyaan['p3']; ?></td>
                                                                            <td>
                                                                                <?php
                                                                                if ($d_pertanyaan['skor'] == 1) echo '<span class="badge badge-danger text-lg">' . $d_pertanyaan['skor'] . '</span>';
                                                                                elseif ($d_pertanyaan['skor'] == 2) echo '<span class="badge badge-warning text-lg">' . $d_pertanyaan['skor'] . '</span>';
                                                                                elseif ($d_pertanyaan['skor'] == 3) echo '<span class="badge badge-success text-lg">' . $d_pertanyaan['skor'] . '</span>';
                                                                                else echo '<span class="badge badge-danger">ERROR!</span>';
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                        $no0++;
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                            <?php
                                                            try {
                                                                $sql_ket = "SELECT * FROM tb_logbook_ked_coass_lppp_ket ";
                                                                $sql_ket .= " WHERE id_praktikan = " . $d_bimbingan['id_praktikan'];
                                                                // echo "$sql_ket<br>";
                                                                $q_ket = $conn->query($sql_ket);
                                                                $r_ket = $q_ket->rowCount();
                                                                $d_ket = $q_ket->fetch(PDO::FETCH_ASSOC);
                                                            } catch (PDOException $ex) {
                                                                echo "<script>alert('DATA KET');</script>";
                                                                echo "<script>document.location.href='?error404';</script>";
                                                            }
                                                            ?>
                                                            <hr class="">
                                                            <div class="text-center mb-2">
                                                                Kejadian-kejadian terkait dengan perilaku Profesional selama kegiatan kepaniteraan berlangsung
                                                                <div class="border-1">
                                                                    <?php if ($r_ket > 0) { ?>
                                                                        <div class='b'><?= $d_ket['ket'] ?></div>
                                                                    <?php } else { ?>
                                                                        <div class='text-danger'>DATA TIDAK ADA</div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <span class='badge badge-secondary'>Data Belum Ada</span>
                                        <?php } ?>
                                    </td>
                                    <td class=" text-center">
                                        <a class="btn btn-info btn-sm" href="?ked_coass_elogbook=lppp&u=<?= urlencode(encryptString($d_bimbingan['id_praktikan'], $customkey)) ?>">
                                            Lembar Penilaian Perilaku Profesional
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