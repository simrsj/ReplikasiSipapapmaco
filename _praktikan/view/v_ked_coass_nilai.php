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
        try {
            $sql_nilai = "SELECT * FROM tb_nilai_ked_coass ";
            $sql_nilai .= " WHERE id_praktikan = " .  $idpr;
            // echo "$sql_nilai<br>";
            $q_nilai = $conn->query($sql_nilai);
            $d_nilai = $q_nilai->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            echo "<script>alert('DATA PRAKTIKAN');</script>";
            echo "<script>document.location.href='?error404';</script>";
        }
        ?>
        <div class="row">
            <div class="col-md-3 d-block">
                <div class="card shadow  m-2">
                    <div class="card-header b text-center">
                        Data Praktikan
                    </div>
                    <div class="card-body text-center">
                        <img height="100" height="80" src="<?= $d_praktikan['foto_praktikan'] ?>"><br>
                        Nama Praktikan : <br>
                        <strong><?= $d_praktikan['nama_praktikan'] ?></strong> <br>
                        No. ID Praktikan : <br>
                        <strong><?= $d_praktikan['no_id_praktikan'] ?></strong> <br>
                        Nama Institusi : <br>
                        <strong> <?= $d_praktikan['nama_institusi'] ?> </strong><br>
                        Nama Kelompok/Gelombang/Praktik : <br>
                        <strong> <?= $d_praktikan['nama_praktik'] ?></strong>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card shadow m-2 rounded-5">
                    <div class="card-header b">
                        Data Nilai
                    </div>
                    <div class="card-body text-center">
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th scope='col'>No</th>
                                        <th>Materi</th>
                                        <th width="100">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>BST (BEDSIDE TEACHING)</td>
                                        <td><?= $d_nilai['bst'] == "" ? '<span class="badge badge-danger">BELUM DINILAI</span>' : $d_nilai['bst'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>CRS (CASE REPORT SESSION/TUTORIAL)</td>
                                        <td><?= $d_nilai['crs'] == "" ? '<span class="badge badge-danger">BELUM DINILAI</span>' : $d_nilai['crs'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>CSS (CLINICAL SCIENCE SESSION/REFERAT/JOURNAL READING)</td>
                                        <td><?= $d_nilai['css'] == "" ? '<span class="badge badge-danger">BELUM DINILAI</span>' : $d_nilai['css'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td>MINI C-EX (MINI CLINICAL EXAMINATION)</td>
                                        <td><?= $d_nilai['minicex'] == "" ? '<span class="badge badge-danger">BELUM DINILAI</span>' : $d_nilai['minicex'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">5</td>
                                        <td>RPS (RESOURCE PERSON SESION)</td>
                                        <td><?= $d_nilai['rps'] == "" ? '<span class="badge badge-danger">BELUM DINILAI</span>' : $d_nilai['rps'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">6</td>
                                        <td>OSLER (OBJECTIVE STRUKTURED LONG EXAMINATION STRUKTURED)</td>
                                        <td><?= $d_nilai['osler'] == "" ? '<span class="badge badge-danger">BELUM DINILAI</span>' : $d_nilai['osler'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">7</td>
                                        <td>DOPS (DIRECT OBSERVATION PROCEDURAL SKILLS)</td>
                                        <td><?= $d_nilai['dops'] == "" ? '<span class="badge badge-danger">BELUM DINILAI</span>' : $d_nilai['dops'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">8</td>
                                        <td>CBD (CASE BASED DISCUSSION)</td>
                                        <td><?= $d_nilai['cbd'] == "" ? '<span class="badge badge-danger">BELUM DINILAI</span>' : $d_nilai['cbd'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>