<?php

include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";

//Mencari Data Praktik
$id_praktik = $_POST['id'];
$cek_pilih_ujian = $_POST['cek_pilih_ujian'];
$sql_praktik = "SELECT * FROM tb_praktik 
JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd
WHERE tb_praktik.id_praktik = " . $id_praktik;

$q_praktik = $conn->query($sql_praktik);
$d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC);

$id_jurusan_pdd = $d_praktik['id_jurusan_pdd'];
$id_jenjang_pdd = $d_praktik['id_jenjang_pdd'];
$tgl_mulai_praktik = $d_praktik['tgl_mulai_praktik'];
$tgl_selesai_praktik = $d_praktik['tgl_selesai_praktik'];
$jumlah_praktik = $d_praktik['jumlah_praktik'];
?>
<!-- Data Tarif Praktik  -->
<div class='card shadow mb-4' id="tarif_praktik">
    <div class='card-body'>
        <div class="text-lg font-weight-bold text-center">DATA TARIF</div>
        <input type="hidden" name="path" id="path" value="<?= $_GET['it_ked']; ?>">

        <!-- Menu Tarif wajib disesuaikan dengan jenis jurusan -->
        <div class="text-gray-700">
            <div class="h5 font-weight-bold text-center mt-2">Menu Tarif Wajib <?= $d_praktik['nama_jurusan_pdd']; ?></div>
        </div>
        <hr>
        <?php
        $sql_tarif_jurusan = " SELECT * FROM tb_tarif 
                JOIN tb_tarif_jenis ON tb_tarif.id_tarif_jenis = tb_tarif_jenis.id_tarif_jenis 
                JOIN tb_tarif_satuan ON tb_tarif.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan  
                WHERE tb_tarif.id_jurusan_pdd = $id_jurusan_pdd AND tb_tarif.id_tarif_jenis BETWEEN 1 AND 5 AND tb_tarif.id_jenjang_pdd = 0
                ORDER BY nama_tarif_jenis ASC, nama_tarif ASC 
                ";

        // echo $sql_tarif_jurusan . "<br>";
        $q_tarif_jurusan = $conn->query($sql_tarif_jurusan);
        $r_tarif_jurusan = $q_tarif_jurusan->rowCount();

        if ($r_tarif_jurusan > 0) {
        ?>
            <table class="table table-hover text-md">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Jenis</th>
                        <th scope="col">Nama Tarif</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Tarif</th>
                        <th scope="col">Frekuensi</th>
                        <th scope="col">Kuantitas</th>
                        <th scope="col">Total Tarif</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $jumlah_total = 0;
                    $jumlah_total_wajib = 0;
                    $no = 1;
                    while ($d_tarif_jurusan = $q_tarif_jurusan->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $d_tarif_jurusan['nama_tarif_jenis']; ?></td>
                            <td><?= $d_tarif_jurusan['nama_tarif']; ?></td>
                            <td><?= $d_tarif_jurusan['nama_tarif_satuan']; ?></td>
                            <td><?= "Rp " . number_format($d_tarif_jurusan['jumlah_tarif'], 0, ",", "."); ?></td>
                            <td> <?= $_POST['frek' . $d_tarif_jurusan['id_tarif']]; ?></td>
                            <td> <?= $_POST['ktt' . $d_tarif_jurusan['id_tarif']]; ?></td>
                            <td>
                                <?= "Rp " . number_format($_POST['frek' . $d_tarif_jurusan['id_tarif']] * $_POST['ktt' . $d_tarif_jurusan['id_tarif']] * $d_tarif_jurusan['jumlah_tarif'], 0, ",", "."); ?>
                            </td>
                            <?php
                            $jumlah_total_wajib = ($_POST['frek' . $d_tarif_jurusan['id_tarif']] * $_POST['ktt' . $d_tarif_jurusan['id_tarif']] * $d_tarif_jurusan['jumlah_tarif']) + $jumlah_total_wajib;
                            $no++;
                            ?>
                        </tr>
                    <?php

                    }
                    $jumlah_total += $jumlah_total_wajib;
                    ?>
                    <tr>
                        <td colspan="7" class="font-weight-bold text-right">JUMLAH TOTAL : </td>
                        <td class="font-weight-bold"><?= "Rp " . number_format($jumlah_total_wajib, 0, ",", "."); ?></td>
                    </tr>
                </tbody>
            </table>
        <?php
        }
        ?>
        <hr>

        <!-- Cek tarif ujian -->
        <?php
        if ($_POST['cek_pilih_ujian'] == 'y') {

        ?>
            <div class="text-gray-700">
                <div class="h5 font-weight-bold text-center mt-3 mb-3">
                    Pakai Tarif Ujian <?= $d_praktik['nama_jurusan_pdd']; ?>
                </div>
            </div>
            <?php
            $sql_tarif_ujian = " SELECT * FROM tb_tarif 
                                JOIN tb_tarif_jenis ON tb_tarif.id_tarif_jenis = tb_tarif_jenis.id_tarif_jenis 
                                JOIN tb_tarif_satuan ON tb_tarif.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan 
                                WHERE tb_tarif.id_tarif_jenis = 6 AND tb_tarif.id_jurusan_pdd = " . $d_praktik['id_jurusan_pdd'] . "
                                ORDER BY nama_tarif_jenis ASC
                                ";

            // echo $sql_tarif_ujian;
            $q_tarif_ujian = $conn->query($sql_tarif_ujian);
            $r_tarif_ujian = $q_tarif_ujian->rowCount();

            if ($r_tarif_ujian > 0) {
            ?>
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Jenis</th>
                            <th scope="col">Nama Tarif</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Tarif</th>
                            <th scope="col">Frekuensi</th>
                            <th scope="col">Kuantitas</th>
                            <th scope="col">Total Tarif</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $jumlah_total_ujian = 0;
                        $no = 1;
                        while ($d_tarif_ujian = $q_tarif_ujian->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no; ?></th>
                                <td><?= $d_tarif_ujian['nama_tarif_jenis']; ?></td>
                                <td><?= $d_tarif_ujian['nama_tarif']; ?></td>
                                <td><?= $d_tarif_ujian['nama_tarif_satuan']; ?></td>
                                <td> <?= "Rp " . number_format($d_tarif_ujian['jumlah_tarif'], 0, ",", "."); ?></td>
                                <td> <?= $_POST['frek' . $d_tarif_ujian['id_tarif']]; ?></td>
                                <td> <?= $_POST['ktt' . $d_tarif_ujian['id_tarif']]; ?></td>
                                <td>
                                    <?= "Rp " . number_format($_POST['frek' . $d_tarif_ujian['id_tarif']] * $_POST['ktt' . $d_tarif_ujian['id_tarif']] * $d_tarif_ujian['jumlah_tarif'], 0, ",", "."); ?>
                                </td>
                            </tr>
                        <?php
                            $jumlah_total_ujian = ($_POST['frek' . $d_tarif_ujian['id_tarif']] * $_POST['ktt' . $d_tarif_ujian['id_tarif']] * $d_tarif_ujian['jumlah_tarif']) + $jumlah_total_ujian;
                            $no++;
                        }

                        $jumlah_total += $jumlah_total_ujian;
                        ?>
                        <tr>
                            <td colspan="7" class="font-weight-bold text-right">JUMLAH TOTAL : </td>
                            <td class="font-weight-bold"><?= "Rp " . number_format($jumlah_total_ujian, 0, ",", "."); ?></td>
                        </tr>
                    </tbody>
                </table>
        <?php
            }
        }
        echo "<hr>";
        ?>
        <div class="text-gray-700">
            <div class="h5 font-weight-bold text-center mt-3 mb-3">
                Menu Tarif Ruang Belajar/Diskusi <?= $d_praktik['nama_jurusan_pdd']; ?>
            </div>
            <?php
            $sql_tempat = " SELECT * FROM tb_tempat
                                JOIN tb_tarif_jenis ON tb_tempat.id_tarif_jenis = tb_tarif_jenis.id_tarif_jenis 
                                JOIN tb_tarif_satuan ON tb_tempat.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan 
                                WHERE tb_tempat.id_tarif_jenis = 7 AND tb_tempat.id_jurusan_pdd_jenis = " . $d_praktik['id_jurusan_pdd_jenis'] . "
                                ORDER BY tb_tempat.nama_tempat ASC
                                ";

            // echo $sql_tarif_ujian;
            $q_tempat = $conn->query($sql_tempat);
            $r_tempat = $q_tempat->rowCount();

            if ($r_tempat > 0) {
            ?>
                <div class="table-responsive" id="tabel_tempat">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Jenis</th>
                                <th scope="col" width="380">Nama Tarif</th>
                                <th scope="col" width="150">Satuan</th>
                                <th scope="col" width="150">Tarif</th>
                                <th scope="col">Frekuensi</th>
                                <th scope="col">Kuantitas</th>
                                <th scope="col">Total Tarif</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $jumlah_total_tempat = 0;
                            $no = 1;
                            while ($d_tempat = $q_tempat->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td><?= $d_tempat['nama_tarif_jenis']; ?></td>
                                    <td><?= $d_tempat['nama_tempat']; ?></td>
                                    <td><?= $d_tempat['nama_tarif_satuan']; ?></td>
                                    <td> <?= "Rp " . number_format($d_tempat['tarif_tempat'], 0, ",", "."); ?></td>
                                    <td> <?= $_POST['frek' . $d_tempat['id_tempat']]; ?></td>
                                    <td> <?= $_POST['ktt' . $d_tempat['id_tempat']]; ?></td>
                                    <td>
                                        <?php
                                        echo "Rp " . number_format($_POST['frek' . $d_tempat['id_tempat']] * $_POST['ktt' . $d_tempat['id_tempat']] * $d_tempat['tarif_tempat'], 0, ",", ".");
                                        ?>
                                    </td>
                                <?php
                                $jumlah_total_tempat = ($_POST['frek' . $d_tempat['id_tempat']] * $_POST['ktt' . $d_tempat['id_tempat']] * $d_tempat['tarif_tempat']) + $jumlah_total_tempat;
                                $no++;
                            }

                            $jumlah_total += $jumlah_total_tempat;
                                ?>
                                <tr>
                                    <td colspan="7" class="font-weight-bold text-right">JUMLAH TOTAL : </td>
                                    <td class="font-weight-bold"><?= "Rp " . number_format($jumlah_total_tempat, 0, ",", "."); ?></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            <?php
            }

            ?>

            <center>
                <span class="badge badge-primary text-lg">
                    <?= "JUMLAH TOTAL KESELURUHAN : Rp" . number_format($jumlah_total, 0, ",", "."); ?>
                </span>
            </center>

            <hr>
            <div id="simpan_praktik_tarif" class="nav btn justify-content-center text-md">
                <button type="button" name="simpan_praktik" id="simpan_praktik" class="btn btn-outline-success" onclick="simpanDataTarif()">
                    <!-- <a class="nav-link" href="#tarif"> -->
                    <i class="fas fa-save"></i>
                    Simpan Data Tarif
                    <i class="fas fa-save"></i>
                    <!-- </a> -->
                </button>
            </div>
        </div>
    </div>