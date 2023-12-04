<?php

include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";

//Mencari Data institusi
$id_institusi = $_GET['id_ins'];
if (empty($_GET['id_ins'])) {
    $id_institusi = $_SESSION['id_institusi'];
}
$sql_institusi = "SELECT * FROM tb_institusi WHERE id_institusi = " . $id_institusi;
$q_institusi = $conn->query($sql_institusi);
$d_institusi = $q_institusi->fetch(PDO::FETCH_ASSOC);

//Mencari Data Jurusan
$id_jurusan_pdd = $_GET['jur'];
$sql_jurusan_pdd = "SELECT * FROM tb_jurusan_pdd WHERE id_jurusan_pdd = " . $id_jurusan_pdd;
$q_jurusan_pdd = $conn->query($sql_jurusan_pdd);
$d_jurusan_pdd = $q_jurusan_pdd->fetch(PDO::FETCH_ASSOC);

//Mencari id_jenjang_pdd
$id_jenjang_pdd = $_GET['jen'];

$tgl_mulai_praktik = $_GET['tmp'];
$tgl_selesai_praktik = $_GET['tsp'];
$jumlah_praktik = $_GET['jum'];
?>

<form class="form-data text-gray-900" method="post" enctype="multipart/form-data" id="form_tarif">
    <!-- Data Tarif Praktik  -->
    <div class='card shadow mb-4' id="tarif_praktik">
        <div class='card-body'>
            <div class="row">
                <div class="col-12 badge badge-primary text-lg font-weight-bold text-center ">MENU TARIF</div>
            </div>
            <input type="hidden" name="path" id="path" value="<?= $_GET['i']; ?>">

            <!-- Menu Tarif wajib disesuaikan dengan jenis jurusan -->
            <div class="text-gray-700 mb-3">
                <div class="h5 font-weight-bold text-center mt-2">Menu Tarif Wajib <?= $d_jurusan_pdd['nama_jurusan_pdd']; ?></div>
            </div>
            <?php
            $sql_tarif_jurusan = " SELECT * FROM tb_tarif";
            $sql_tarif_jurusan .= " JOIN tb_tarif_jenis ON tb_tarif.id_tarif_jenis = tb_tarif_jenis.id_tarif_jenis ";
            $sql_tarif_jurusan .= " JOIN tb_tarif_satuan ON tb_tarif.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan  ";
            $sql_tarif_jurusan .= " WHERE tb_tarif.id_jurusan_pdd = $id_jurusan_pdd AND tb_tarif.id_tarif_jenis BETWEEN 1 AND 5 ";
            $sql_tarif_jurusan .= " AND tb_tarif.id_jenjang_pdd = 0 AND tb_tarif.status_tarif = 'y'";
            $sql_tarif_jurusan .= " ORDER BY nama_tarif_jenis ASC, nama_tarif ASC ";

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
                        $jumlah_total_tarif = 0;
                        $no = 1;
                        while ($d_tarif_jurusan = $q_tarif_jurusan->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no; ?></th>
                                <td><?= $d_tarif_jurusan['nama_tarif_jenis']; ?></td>
                                <td><?= $d_tarif_jurusan['nama_tarif']; ?></td>
                                <td><?= $d_tarif_jurusan['nama_tarif_satuan']; ?></td>
                                <td><?= "Rp " . number_format($d_tarif_jurusan['jumlah_tarif'], 0, ",", "."); ?></td>
                                <td>
                                    <?php

                                    if ($d_tarif_jurusan['tipe_tarif'] == 'SEKALI') {
                                        $frekuensi = 1;
                                    } elseif ($d_tarif_jurusan['tipe_tarif'] == 'TARIF-') {
                                        $frekuensi = tanggal_between_nonweekend($tgl_mulai_praktik, $tgl_selesai_praktik);
                                    } elseif ($d_tarif_jurusan['tipe_tarif'] == 'TARIF+') {
                                        $frekuensi = tanggal_between($tgl_mulai_praktik, $tgl_selesai_praktik);
                                    } elseif ($d_tarif_jurusan['tipe_tarif'] == 'MINGGUAN') {
                                        $frekuensi = tanggal_between_week($tgl_mulai_praktik, $tgl_selesai_praktik);
                                    } else {
                                        $frekuensi = $d_tarif_jurusan['tipe_tarif'];
                                    }
                                    if ($d_tarif_jurusan['frekuensi_tarif'] != 0) {
                                        $frekuensi = $d_tarif_jurusan['frekuensi_tarif'];
                                    }
                                    echo $frekuensi;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($d_tarif_jurusan['kuantitas_tarif'] != 0) {
                                        $kuantitas = $d_tarif_jurusan['kuantitas_tarif'];
                                    } else {
                                        $kuantitas = $jumlah_praktik;
                                    }
                                    echo $kuantitas;
                                    ?>
                                </td>
                                <td>
                                    <?= "Rp " . number_format($frekuensi * $kuantitas * $d_tarif_jurusan['jumlah_tarif'], 0, ",", "."); ?>
                                </td>
                                <?php
                                $jumlah_total_tarif = ($frekuensi * $kuantitas * $d_tarif_jurusan['jumlah_tarif']) + $jumlah_total_tarif;
                                $no++;
                                ?>
                            </tr>
                            <?php
                        }

                        //eksekusi bila jurusan selain dari kedokteran
                        if ($d_jurusan_pdd != 1) {
                            $sql_tarif_jenjang = " SELECT * FROM tb_tarif 
                                    JOIN tb_tarif_jenis ON tb_tarif.id_tarif_jenis = tb_tarif_jenis.id_tarif_jenis 
                                    JOIN tb_jenjang_pdd ON tb_tarif.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd
                                    JOIN tb_tarif_satuan ON tb_tarif.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan 
                                    WHERE tb_tarif.id_jurusan_pdd = " . $id_jurusan_pdd . " AND tb_tarif.id_jenjang_pdd = " . $id_jenjang_pdd . " AND tb_tarif.id_tarif_jenis BETWEEN 1 AND 6
                                    ORDER BY nama_jenjang_pdd ASC
                                    ";

                            // echo $sql_tarif_jenjang . "<br>";
                            $q_tarif_jenjang = $conn->query($sql_tarif_jenjang);

                            while ($d_tarif_jenjang = $q_tarif_jenjang->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td><?= $d_tarif_jenjang['nama_tarif_jenis']; ?></td>
                                    <td><?= $d_tarif_jenjang['nama_tarif']; ?></td>
                                    <td><?= $d_tarif_jenjang['nama_tarif_satuan']; ?></td>
                                    <td><?= "Rp " . number_format($d_tarif_jenjang['jumlah_tarif'], 0, ",", "."); ?></td>
                                    <td>
                                        <?php

                                        if ($d_tarif_jenjang['tipe_tarif'] == 'SEKALI') {
                                            $frekuensi = 1;
                                        } elseif ($d_tarif_jenjang['tipe_tarif'] == 'TARIF-') {
                                            $frekuensi = tanggal_between_nonweekend($tgl_mulai_praktik, $tgl_selesai_praktik);
                                        } elseif ($d_tarif_jenjang['tipe_tarif'] == 'TARIF+') {
                                            $frekuensi = tanggal_between($tgl_mulai_praktik, $tgl_selesai_praktik);
                                        } elseif ($d_tarif_jenjang['tipe_tarif'] == 'MINGGUAN') {
                                            $frekuensi = tanggal_between_week($tgl_mulai_praktik, $tgl_selesai_praktik);
                                        } else {
                                            $frekuensi = $d_tarif_jenjang['tipe_tarif'];
                                        }

                                        if ($d_tarif_jenjang['frekuensi_tarif'] != 0) {
                                            $frekuensi = $d_tarif_jenjang['frekuensi_tarif'];
                                        }
                                        echo $frekuensi;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($d_tarif_jenjang['kuantitas_tarif'] != 0) {
                                            $kuantitas = $d_tarif_jenjang['kuantitas_tarif'];
                                        } else {
                                            $kuantitas = $jumlah_praktik;
                                        }
                                        echo $kuantitas;
                                        ?>
                                    </td>
                                    <td><?= "Rp " . number_format($frekuensi * $kuantitas * $d_tarif_jenjang['jumlah_tarif'], 0, ",", "."); ?></td>
                                </tr>
                        <?php
                                $jumlah_total_tarif = ($frekuensi * $kuantitas * $d_tarif_jenjang['jumlah_tarif']) + $jumlah_total_tarif;
                                $no++;
                            }
                        }
                        ?>
                        <tr>
                            <td colspan="7" class="font-weight-bold text-right">JUMLAH TOTAL : </td>
                            <td class="font-weight-bold"><?= "Rp " . number_format($jumlah_total_tarif, 0, ",", "."); ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php
            } else {
            ?>
                <div class="bg-gray-500 text-gray-100" style="padding-bottom: 2px; padding-top: 5px;">
                    <h5 class="text-center">Data Tarif Tidak Ada</h5>
                </div>
            <?php
            }
            ?>
            <hr>

            <!-- Menu Tambah Materi disesuaikan dengan Jenis Jurusan -->
            <?php
            if ($id_jurusan_pdd == 2) {
            ?>
                <div class="text-gray-700">
                    <div class="h5 font-weight-bold text-center mt-3 mb-3">
                        Tambahan Materi <?= $d_jurusan_pdd['nama_jurusan_pdd']; ?>
                        <span class="font-italic font-weight-bold text-xs">(Optional)</span>
                    </div>
                </div>
                <div class="row boxed-check-group boxed-check-primary justify-content-center">
                    <label class="boxed-check">
                        <input class="boxed-check-input" type="checkbox" name="materi_upip" id="materi_upip" value="y">
                        <div class="boxed-check-label">UPIP</div>
                    </label>
                    &nbsp;
                    &nbsp;
                    <label class="boxed-check">
                        <input class="boxed-check-input" type="checkbox" name="materi_napza" id="materi_napza" value="y">
                        <div class="boxed-check-label">Napza</div>
                    </label>
                </div>
                <hr>
            <?php
            }
            ?>

            <!-- Menu Tarif Ujian disesuaikan dengan Jenis Jurusan -->
            <div class="text-gray-700">
                <div class="h5 font-weight-bold text-center mt-3 mb-3">
                    Menu Tarif Ujian <?= $d_jurusan_pdd['nama_jurusan_pdd']; ?> <span class="text-danger">*</span>
                </div>
            </div>
            <div class="row boxed-check-group boxed-check-primary justify-content-center mb-0">
                <label class="boxed-check">
                    <input class="boxed-check-input " type="radio" name="cek_pilih_ujian" id="cek_pilih_ujian1" value="y" onclick="cekPilihUjianY()">
                    <div class="boxed-check-label">Ya</div>
                </label>
                &nbsp;
                &nbsp;
                <label class="boxed-check">
                    <input class="boxed-check-input " type="radio" name="cek_pilih_ujian" id="cek_pilih_ujian2" value="t" onclick="cekPilihUjianT()">
                    <div class="boxed-check-label">Tidak</div>
                </label>
            </div>
            <div class="text-center text-danger font-weight-bold font-italic text-md blink" id="err_cek_pilih_ujian"></div>
            <!-- tabel tarif ujian -->
            <div id="tarif_ujian" class="mt-4" style="display: none;">
                <?php
                $sql_tarif_ujian = " SELECT * FROM tb_tarif ";
                $sql_tarif_ujian .= " JOIN tb_tarif_jenis ON tb_tarif.id_tarif_jenis = tb_tarif_jenis.id_tarif_jenis ";
                $sql_tarif_ujian .= " JOIN tb_tarif_satuan ON tb_tarif.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan ";
                $sql_tarif_ujian .= " WHERE tb_tarif.id_tarif_jenis = 6 AND tb_tarif.id_jurusan_pdd = " . $id_jurusan_pdd;
                $sql_tarif_ujian .= " ORDER BY nama_tarif_jenis ASC";

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
                                    <td>
                                        <?php

                                        if ($d_tarif_ujian['tipe_tarif'] == 'SEKALI') {
                                            $frekuensi = 1;
                                        } elseif ($d_tarif_ujian['tipe_tarif'] == 'INPUT') {
                                        ?>
                                            <input class="form-control" name="<?= $d_praktik['id_praktik'] . "-" . $d_tarif_ujian['id_tarif'] ?>">
                                        <?php
                                        } elseif ($d_tarif_ujian['tipe_tarif'] == 'TARIF-') {
                                            $frekuensi = tanggal_between_nonweekend($tgl_mulai_praktik, $tgl_selesai_praktik);
                                        } elseif ($d_tarif_ujian['tipe_tarif'] == 'TARIF+') {
                                            $frekuensi = tanggal_between($tgl_mulai_praktik, $tgl_selesai_praktik);
                                        } elseif ($d_tarif_ujian['tipe_tarif'] == 'MINGGUAN') {
                                            $frekuensi = tanggal_between_week($tgl_mulai_praktik, $tgl_selesai_praktik);
                                        } else {
                                            $frekuensi = $d_tarif_ujian['tipe_tarif'];
                                        }

                                        if ($d_tarif_ujian['frekuensi_tarif'] != 0) {
                                            $frekuensi = $d_tarif_ujian['frekuensi_tarif'];
                                        }
                                        echo $frekuensi;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($d_tarif_ujian['kuantitas_tarif'] != 0) {
                                            $kuantitas = $d_tarif_ujian['kuantitas_tarif'];
                                        } else {
                                            $kuantitas = $jumlah_praktik;
                                        }
                                        echo $kuantitas;
                                        ?>
                                    </td>
                                    <td><?= "Rp " . number_format($frekuensi * $kuantitas * $d_tarif_ujian['jumlah_tarif'], 0, ",", "."); ?></td>
                                </tr>
                            <?php
                                $jumlah_total_ujian = ($frekuensi * $kuantitas * $d_tarif_ujian['jumlah_tarif']) + $jumlah_total_ujian;
                                $no++;
                            }
                            ?>
                            <tr>
                                <td colspan="7" class="font-weight-bold text-right">JUMLAH TOTAL : </td>
                                <td class="font-weight-bold"><?= "Rp " . number_format($jumlah_total_ujian, 0, ",", "."); ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                } else {
                ?>
                    <div class="bg-gray-500 text-gray-100" style="padding-bottom: 2px; padding-top: 5px;">
                        <h5 class="text-center">Data Tarif Tidak Ada</h5>
                    </div>
                <?php
                }
                ?>
            </div>
            <hr>

            <!-- Menu Mess/Pemondokan -->
            <div class="row">
                <div class="col-12 badge badge-primary text-lg font-weight-bold text-center mb-2">MENU MESS/PEMONDOKAN</div>
            </div>
            <input type="hidden" name="messOpsional_institusi" id="messOpsional_institusi" value="<?= $d_institusi['messOpsional_institusi']; ?>">
            <?php
            if ($d_institusi['messOpsional_institusi'] == 'Y') {
                $display_makan_mess = "display:none;";
                $display_pemilihan_mess = "display:block;";
            } else {
                $display_makan_mess = "display:block;";
                $display_pemilihan_mess = "display:none;";
            }
            ?>

            <!-- pemilihan mess/pemondokan  -->
            <div style="<?= $display_pemilihan_mess; ?>">
                <div class="text-gray-700">
                    <div class="h5 font-weight-bold text-center mb-3">
                        Pilih Mess/Pemondokan<span class="text-danger">*</span>
                    </div>
                </div>
                <div class="row boxed-check-group boxed-check-primary justify-content-center mb-0">
                    <label class="boxed-check">
                        <input class="boxed-check-input" type="radio" name="pilih_mess" id="pilih_mess1" value="Y">
                        <div class="boxed-check-label">Ya</div>
                    </label>
                    &nbsp;
                    &nbsp;
                    <label class="boxed-check">
                        <input class="boxed-check-input" type="radio" name="pilih_mess" id="pilih_mess2" value="T">
                        <div class="boxed-check-label">Tidak</div>
                    </label>
                </div>
                <div class="text-center text-danger font-weight-bold font-italic text-md blink" id="err_pilih_mess"></div>
            </div>
            <!-- pemilihan makan mess/pemondokan  -->
            <div id="pilih_makan_mess" style="<?= $display_makan_mess; ?>">
                <div class="text-gray-700">
                    <div class="h5 font-weight-bold text-center mt-3 mb-3">
                        Pemilihan Mess/Pemondokan dengan Makan <span class="text-danger">*</span>
                        <span class="font-italic font-weight-bold text-xs">(Tempat Akan dipilih oleh Admin)</span>
                    </div>
                </div>
                <div class="row boxed-check-group boxed-check-primary justify-content-center mb-0">
                    <label class="boxed-check">
                        <input class="boxed-check-input" type="radio" name="makan_mess" id="makan_mess1" value="y">
                        <div class="boxed-check-label">Dengan Makan (3x Sehari)</div>
                    </label>
                    &nbsp;
                    &nbsp;
                    <label class="boxed-check">
                        <input class="boxed-check-input" type="radio" name="makan_mess" id="makan_mess2" value="t">
                        <div class="boxed-check-label">Tanpa Makan</div>
                    </label>
                </div>
                <div class="text-center text-danger font-weight-bold font-italic text-md blink" id="err_makan_mess"></div>
            </div>
            <hr>

            <!-- tombol simpan data praktik dan tarif  -->
            <div id="simpan_praktik_tarif" class="nav btn justify-content-center text-md">
                <button type="button" name="simpan_praktik" id="simpan_praktik" class="btn btn-outline-success" onclick="simpan_tarif()">
                    <i class="fas fa-check-circle"></i> Simpan Praktik dan Tarif <i class="fas fa-check-circle"></i>
                </button>
            </div>
        </div>
    </div>
</form>