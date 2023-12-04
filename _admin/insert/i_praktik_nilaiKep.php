<?php if (isset($_GET['pnilai']) && isset($_GET['pmbb']) && isset($_GET['i']) && $d_prvl['c_praktik_nilai'] == "Y") {
    $id_praktik = base64_decode(urldecode($_GET['pnilai']));
    $id_pembimbing = base64_decode(urldecode($_GET['pmbb']));;

    if (!isset($_POST['simpan_nilai_kep'])) {
?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="h3 mb-2 text-gray-800">Input Nilai</h1>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <?php
                    $sql_data_praktikan = "SELECT * FROM tb_pembimbing_pilih ";
                    $sql_data_praktikan .= " JOIN tb_praktikan ON tb_pembimbing_pilih.id_praktikan = tb_praktikan.id_praktikan";
                    $sql_data_praktikan .= " JOIN tb_pembimbing ON tb_pembimbing_pilih.id_pembimbing = tb_pembimbing.id_pembimbing";
                    $sql_data_praktikan .= " JOIN tb_unit ON tb_pembimbing_pilih.id_unit = tb_unit.id_unit";
                    $sql_data_praktikan .= " WHERE tb_pembimbing_pilih.id_praktik = " . $id_praktik;
                    $sql_data_praktikan .= " AND tb_pembimbing_pilih.id_pembimbing = " . $id_pembimbing;
                    $sql_data_praktikan .= " ORDER BY tb_praktikan.nama_praktikan ASC";
                    // echo $sql_data_praktikan . "<br>";
                    try {
                        $q_data_praktikan = $conn->query($sql_data_praktikan);
                        $q1_data_praktikan = $conn->query($sql_data_praktikan);
                    } catch (Exception $ex) {
                        echo "<script>alert('$ex -DATA PRAKTIKAN-');";
                        echo "document.location.href='?error404';</script>";
                    }
                    $r_data_praktikan = $q_data_praktikan->rowCount();
                    $j_ptkn = $r_data_praktikan;
                    $d1_data_praktikan = $q1_data_praktikan->fetch(PDO::FETCH_ASSOC);
                    if ($r_data_praktikan > 0) {
                    ?>
                        <form method="POST" id="form_nilai_kep">
                            <!-- data praktikan  -->

                            Nama Pembimbing : <?= $d1_data_praktikan['nama_pembimbing']; ?><br>
                            Ruangan : <?= $d1_data_praktikan['nama_unit']; ?>
                            <hr>
                            <span class="table-responsive text-xs">
                                <table class="table table-striped">
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">NIM / NPM / NIS</th>
                                            <th scope="col" width="150px">LP</th>
                                            <th scope="col" width="150px">Pre-Post</th>
                                            <th scope="col" width="150px">SPTK</th>
                                            <th scope="col" width="150px">PENKES</th>
                                            <th scope="col" width="150px">DOKEP</th>
                                            <th scope="col" width="150px">KOMTER</th>
                                            <th scope="col" width="150px">TAK</th>
                                            <th scope="col" width="150px">KASUS</th>
                                            <th scope="col" width="150px">UJIAN</th>
                                            <th scope="col" width="150px">SIKAP</th>
                                            <th scope="col">KETERANGAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while ($d_data_praktikan = $q_data_praktikan->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <input type="hidden" name="id_unit" id="id_unit" value="<?= $d_data_praktikan['id_unit']; ?>">
                                            <input type="hidden" name="id_praktik" id="id_praktik" value="<?= $d_data_praktikan['id_praktik']; ?>">
                                            <input type="hidden" name="id_pembimbing" id="id_pembimbing" value="<?= $d_data_praktikan['id_pembimbing']; ?>">
                                            <input type="hidden" name="id_praktikan<?= $no; ?>" id="id_praktikan<?= $no; ?>" value="<?= $d_data_praktikan['id_praktikan']; ?>">
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $d_data_praktikan['nama_praktikan']; ?></td>
                                                <td class="text-center"><?= $d_data_praktikan['no_id_praktikan']; ?></td>
                                                <td scope="col" width="100px">
                                                    <input type="number" class="form-control form-control-xs p-1" widrt maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" min="0" max="100" name="lp<?= $no; ?>" required>
                                                </td>
                                                <td scope="col" width="100px">
                                                    <input type="number" class="form-control form-control-xs p-1" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" min="0" max="100" name="prepost<?= $no; ?>" required>
                                                </td>
                                                <td scope="col" width="100px">
                                                    <input type="number" class="form-control form-control-xs p-1" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" min="0" max="100" name="sptk<?= $no; ?>" required>
                                                </td>
                                                <td scope="col" width="100px">
                                                    <input type="number" class="form-control form-control-xs p-1" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" min="0" max="100" name="penkes<?= $no; ?>" required>
                                                </td>
                                                <td scope="col" width="100px">
                                                    <input type="number" class="form-control form-control-xs p-1" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" min="0" max="100" name="dokep<?= $no; ?>" required>
                                                </td>
                                                <td scope="col" width="100px">
                                                    <input type="number" class="form-control form-control-xs p-1" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" min="0" max="100" name="komter<?= $no; ?>" required>
                                                </td>
                                                <td scope="col" width="100px">
                                                    <input type="number" class="form-control form-control-xs p-1" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" min="0" max="100" name="tak<?= $no; ?>" required>
                                                </td>
                                                <td scope="col" width="100px">
                                                    <input type="number" class="form-control form-control-xs p-1" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" min="0" max="100" name="kasus<?= $no; ?>" required>
                                                </td>
                                                <td scope="col" width="100px">
                                                    <input type="number" class="form-control form-control-xs p-1" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" min="0" max="100" name="ujian<?= $no; ?>" required>
                                                </td>
                                                <td scope="col" width="100px">
                                                    <input type="number" class="form-control form-control-xs p-1" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" min="0" max="100" name="sikap<?= $no; ?>" required>
                                                </td>
                                                <td scope="col">
                                                    <textarea class="form-control form-control-xs p-1" name="ket<?= $no; ?>" id="ket<?= $no; ?>" rows="2" required></textarea>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                        <input type="hidden" name="jp" id="jp" value="<?= $no; ?>">
                                    </tbody>
                                </table>
                            </span>
                            <div colspan="14" class="font-weight-bold font-italic text-center">
                                "Bila ada jenis nilai yang tidak diperlukan, isikan nilai <span class="text-danger">0</span>"
                            </div>
                            <hr>
                            <!-- tombol simpan pilih Pembimbing dan Ruangan  -->
                            <span class="nav btn justify-content-center text-md">
                                <button type="submit" name="simpan_nilai_kep" class="btn btn-outline-success">
                                    <i class="fas fa-check-circle"></i>
                                    Simpan Pembimbing dan Ruangan Praktik
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            </span>
                        </form>
                    <?php
                    } else {
                    ?>
                        <div class="jumbotron">
                            <div class="jumbotron-fluid">
                                <div class="text-gray-700">
                                    <h5 class="text-center">Data Nilai Tidak Ada</h5>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
    } else {
        $jp = $_POST['jp'];

        $no = 1;
        while ($jp > $no) {
            $sql = "INSERT INTO tb_nilai_kep (";
            $sql .= " id_praktikan, ";
            $sql .= " id_pembimbing, ";
            $sql .= " id_praktik, ";
            $sql .= " id_unit, ";
            $sql .= " lp, ";
            $sql .= " prepost, ";
            $sql .= " sptk, ";
            $sql .= " penkes, ";
            $sql .= " dokep, ";
            $sql .= " komter, ";
            $sql .= " tak, ";
            $sql .= " kasus, ";
            $sql .= " ujian, ";
            $sql .= " sikap, ";
            $sql .= " ket_nilai";
            $sql .= " )VALUES( ";
            $sql .= " '" . $_POST['id_praktikan' . $no] . "',";
            $sql .= " '" . $_POST['id_pembimbing'] . "', ";
            $sql .= " '" . $_POST['id_praktik'] . "', ";
            $sql .= " '" . $_POST['id_unit'] . "', ";
            $sql .= " '" . $_POST['lp' . $no] . "',";
            $sql .= " '" . $_POST['prepost' . $no] . "', ";
            $sql .= " '" . $_POST['sptk' . $no] . "',";
            $sql .= " '" . $_POST['penkes' . $no] . "',";
            $sql .= " '" . $_POST['dokep' . $no] . "',";
            $sql .= " '" . $_POST['komter' . $no] . "',";
            $sql .= " '" . $_POST['tak' . $no] . "', ";
            $sql .= " '" . $_POST['kasus' . $no] . "',";
            $sql .= " '" . $_POST['ujian' . $no] . "', ";
            $sql .= " '" . $_POST['sikap' . $no] . "',";
            $sql .= " '" . $_POST['ket' . $no] . "'";
            $sql .= " )";

            // echo "$sql<br>";
            $conn->query($sql);
            $no++;
        }
    ?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    allowOutsideClick: false,
                    // isDismissed: false,
                    icon: 'success',
                    title: '<span class"text-xs"><b>DATA NILAI</b><br>Berhasil disimpan',
                    showConfirmButton: false,
                    html: '<a href="?pnilai" class="btn btn-outline-primary">OK</a>',
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                }).then(
                    function() {
                        document.location.href = "?pnilai";
                    }
                );
            });
        </script>
<?php
    }
} else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}
?>