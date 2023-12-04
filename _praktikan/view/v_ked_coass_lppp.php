<div class="container-fluid">
    <?php
    $idpr = urldecode(decryptString($_SESSION['id_praktikan'], $customkey));
    try {
        $sql_praktikan = "SELECT * FROM tb_praktikan ";
        $sql_praktikan .= " JOIN tb_praktik ON tb_praktikan.id_praktik = tb_praktik.id_praktik";
        $sql_praktikan .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
        $sql_praktikan .= " WHERE id_praktikan = " .  $idpr;
        // echo "$sql_praktikan<br>";
        $q_praktikan = $conn->query($sql_praktikan);
        $d_praktikan = $q_praktikan->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "<script>alert('DATA BIMBINGAN PRAKTIKAN')</script>;";
        echo "<script>document.location.href='?error404';</script>";
    }
    ?>
    <div class="card shadow  m-2">
        <div class="card-header b text-center">
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
                <div class="card-header b ">
                    Lembar Penilaian Perilaku Profesional
                </div>
                <div class="card-body text-center">
                    <div class="table-responsive text-sm">
                        <table class="table table-striped table-bordered ">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <th scope='col'>No</th>
                                    <th>Aspek Penilaian</th>
                                    <th>Ket Skor <span class="badge badge-danger">1</span></th>
                                    <th>Ket Skor <span class="badge badge-warning">2</span></th>
                                    <th>Ket Skor <span class="badge badge-success">3</span></th>
                                    <th width="200px">SKOR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                try {
                                    $sql_pertanyaan = "SELECT * FROM tb_pertanyaan ";
                                    $sql_pertanyaan .= " WHERE kategori_pertanyaan = 'LPPP'";
                                    // echo "$sql_pertanyaan<br>";
                                    $q_pertanyaan = $conn->query($sql_pertanyaan);
                                } catch (Exception $ex) {
                                ?>
                                    <script>
                                        alert("<?= $ex->getMessage() . $ex->getLine() ?>");
                                        document.location.href = '?error404';
                                    </script>
                                    <?php
                                }
                                $no = 1;
                                while ($d_pertanyaan = $q_pertanyaan->fetch(PDO::FETCH_ASSOC)) {
                                    try {
                                        $sql_lppp = "SELECT * FROM tb_logbook_ked_coass_lppp ";
                                        $sql_lppp .= " WHERE id_praktikan = " . $idpr;
                                        $sql_lppp .= " AND id_pertanyaan = " . $d_pertanyaan['id'];
                                        // echo "$sql_nilai_p3d<br>";
                                        $q_lppp = $conn->query($sql_lppp);
                                        $d_lppp = $q_lppp->fetch(PDO::FETCH_ASSOC);
                                    } catch (Exception $ex) {
                                    ?>
                                        <script>
                                            alert("<?= $ex->getMessage() . $ex->getLine() ?>");
                                            document.location.href = '?error404';
                                        </script>
                                    <?php
                                    }
                                    ?>
                                    <tr class="m-auto">
                                        <td class="text-center"><?= $no; ?></td>
                                        <td><?= $d_pertanyaan['pertanyaan']; ?></td>
                                        <td><?= $d_pertanyaan['p1']; ?></td>
                                        <td><?= $d_pertanyaan['p2']; ?></td>
                                        <td><?= $d_pertanyaan['p3']; ?></td>
                                        <td style="vertical-align: middle; text-align: center;">
                                            <?php
                                            if ($d_lppp['skor'] == 1) echo '<span class="text-lg badge badge-danger">1</span>';
                                            elseif ($d_lppp['skor'] == 2) echo '<span class="text-lg badge badge-warning">2</span>';
                                            elseif ($d_lppp['skor'] == 3) echo '<span class="text-lg badge badge-success">3</span>';
                                            else echo '<span class="text-lg badge badge-secondary">Skor Belum Ada</span>';
                                            ?>
                                        </td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="text-center mb-2">
                            Kejadian-kejadian terkait dengan perilaku Profesional selama kegiatan kepaniteraan berlangsung
                            <?php
                            try {
                                $sql_lppp_ket = "SELECT * FROM tb_logbook_ked_coass_lppp_ket ";
                                $sql_lppp_ket .= " WHERE id_praktikan = " . $idpr;
                                // echo "$sql_nilai_p3d<br>";
                                $q_lppp_ket = $conn->query($sql_lppp_ket);
                                $r_lppp_ket = $q_lppp_ket->rowCount();
                                $d_lppp_ket = $q_lppp_ket->fetch(PDO::FETCH_ASSOC);
                            } catch (Exception $ex) {
                            ?>
                                <script>
                                    alert("<?= $ex->getMessage() . $ex->getLine() ?>");
                                    document.location.href = '?error404';
                                </script>
                            <?php
                            }
                            ?>
                            <div class="jumbotron">
                                <div class="jumbotron-fluid ">
                                    <h5 class="text-center">
                                        <?php
                                        if ($r_lppp_ket > 0) echo $d_lppp_ket['ket'];
                                        else echo "<span class='badge badge-secondary text-lg'>DATA TIDAK ADA</span>"
                                        ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>