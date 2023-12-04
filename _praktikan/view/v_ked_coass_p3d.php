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
                <div class="card-header b">
                    Pencapaian Kompetensi Keterampilan (P3D)
                </div>
                <div class="card-body text-center">
                    <div class="table-responsive text-sm">
                        <form id="form_nilai" method="post">
                            <table class="table table-striped table-bordered ">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th scope='col'>No</th>
                                        <th>Pertanyaan</th>
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
                                        echo "<script>alert('DATA PRAKTIKAN');</script>";
                                        echo "<script>document.location.href='?error404';</script>";
                                    }
                                    $no = 1;
                                    while ($d_pertanyaan = $q_pertanyaan->fetch(PDO::FETCH_ASSOC)) {
                                        try {
                                            $sql_nilai_p3d = "SELECT * FROM tb_logbook_ked_coass_p3d ";
                                            $sql_nilai_p3d .= " WHERE id_praktikan = " . $idpr;
                                            $sql_nilai_p3d .= " AND id_pertanyaan = " . $d_pertanyaan['id'];
                                            // echo "$sql_nilai_p3d<br>";
                                            $q_nilai_p3d = $conn->query($sql_nilai_p3d);
                                            $d_nilai_p3d = $q_nilai_p3d->fetch(PDO::FETCH_ASSOC);
                                        } catch (Exception $ex) {
                                            echo "<script>alert('DATA NILAI P3D');</script>";
                                            echo "<script>document.location.href='?error404';</script>";
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no; ?></td>
                                            <td><?= $d_pertanyaan['pertanyaan']; ?></td>
                                            <td><?= $d_nilai_p3d['i'] == "Y" ? '<i class="fa-solid  text-lg fa-circle-check text-success"></i>' : '<i class="fa-solid  text-lg fa-circle-xmark text-danger"></i>'; ?></td>
                                            <td><?= $d_nilai_p3d['ii'] == "Y" ? '<i class="fa-solid  text-lg fa-circle-check text-success"></i>' : '<i class="fa-solid  text-lg fa-circle-xmark text-danger"></i>'; ?></td>
                                            <td><?= $d_nilai_p3d['iii'] == "Y" ? '<i class="fa-solid  text-lg fa-circle-check text-success"></i>' : '<i class="fa-solid  text-lg fa-circle-xmark text-danger"></i>'; ?></td>
                                            <td><?= $d_nilai_p3d['iv'] == "Y" ? '<i class="fa-solid  text-lg fa-circle-check text-success"></i>' : '<i class="fa-solid  text-lg fa-circle-xmark text-danger"></i>'; ?></td>
                                        </tr>
                                        <?php $no++; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>