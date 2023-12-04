<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10">
            <h1 class="h3 mb-2 text-gray-800">Daftar Tarif</h1>
        </div>
        <div class="col-lg-2">
            <div class="dropdown show">

                <!-- tambah tarif -->
                <a class='btn btn-outline-success btn-sm' href='#' data-toggle='modal' data-target='#trf_i_m'>
                    <i class="fas fa-plus"></i> Tambah
                </a>

                <!-- modal tambah Tarif  -->
                <div class="modal fade" id="trf_i_m">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="post" action="">
                                <div class="modal-header">
                                    Tambah Tarif :
                                </div>
                                <div class="modal-body">
                                    Nama Tarif : <span class="text-danger">*</span><br>
                                    <input class="form-control" name="nama_tarif" required><br>
                                    Satuan Tarif : <span class="text-danger">*</span><br>
                                    <?php
                                    $sql_tarif_satuan = "SELECT * FROM tb_tarif_satuan order by nama_tarif_satuan ASC";

                                    $q_tarif_satuan = $conn->query($sql_tarif_satuan);
                                    $r_tarif_satuan = $q_tarif_satuan->rowCount();

                                    if ($r_tarif_satuan > 0) {
                                    ?>
                                        <select class="form-control text-center" name="id_tarif_satuan" required>
                                            <option value="">-- Pilih Jenis Tarif --</option>
                                            <?php
                                            while ($d_tarif_satuan = $q_tarif_satuan->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value='<?= $d_tarif_satuan['id_tarif_satuan']; ?>'>
                                                    <?= $d_tarif_satuan['nama_tarif_satuan']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    <?php
                                    } else {
                                    ?>
                                        <b><i>Data Satuan Tarif Tidak Ada</i></b>
                                    <?php
                                    }
                                    ?>
                                    <br>

                                    Tipe Tarif: <span class="text-danger">*</span><br>
                                    <select class="form-control text-center" name="tipe_tarif" id="tambahTipeTarif" onChange='tambah_tipeTarif()' required>
                                        <option value="">-- Pilih --</option>
                                        <option value="SEKALI">Sekali</option>
                                        <option value="INPUT">Diinput Manual</option>
                                        <option value="HARI-">Harian Tidak Termasuk Sabtu Minggu</option>
                                        <option value="HARI+">Harian Termasuk Sabtu Minggu</option>
                                        <option value="MINGGU">Mingguan</option>
                                        <option value="-- LAINNYA --">-- LAINNYA --</option>
                                    </select>
                                    <br>

                                    <div id="tambahFrekKuanTarif"></div>

                                    Jumlah Tarif : <i style='font-size:12px;'>(Rp)</i><span class="text-danger">*</span><br>
                                    <input class="form-control" name="jumlah_tarif" type="number" min="1" required>
                                    <i style='font-size:12px;'>Isian hanya berupa angka</i><br><br>
                                    Jenis Tarif : <span class="text-danger">*</span><br>
                                    <?php
                                    $sql_tarif_jenis = "SELECT * FROM tb_tarif_jenis order by nama_tarif_jenis ASC";

                                    $q_tarif_jenis = $conn->query($sql_tarif_jenis);
                                    $r_tarif_jenis = $q_tarif_jenis->rowCount();

                                    if ($r_tarif_jenis > 0) {
                                    ?>
                                        <select class="form-control text-center" name="id_tarif_jenis" required>
                                            <option value="">-- Pilih Jenis Tarif --</option>
                                            <?php
                                            while ($d_tarif_jenis = $q_tarif_jenis->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value='<?= $d_tarif_jenis['id_tarif_jenis']; ?>'>
                                                    <?= $d_tarif_jenis['nama_tarif_jenis']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    <?php
                                    } else {
                                    ?>
                                        <b><i>Data Jenis Tarif Tidak Ada</i></b>
                                    <?php
                                    }
                                    ?>
                                    <br>

                                    Jurusan : <span class="text-danger">*</span><br>
                                    <?php
                                    $sql_jurusan_pdd = "SELECT * FROM tb_jurusan_pdd order by nama_jurusan_pdd ASC";

                                    $q_jurusan_pdd = $conn->query($sql_jurusan_pdd);
                                    $r_jurusan_pdd = $q_jurusan_pdd->rowCount();

                                    if ($r_jurusan_pdd > 0) {
                                    ?>
                                        <select class="form-control text-center" name="id_jurusan_pdd" required>
                                            <option value="">-- Pilih Jurusan --</option>
                                            <?php
                                            while ($d_jurusan_pdd = $q_jurusan_pdd->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value='<?= $d_jurusan_pdd['id_jurusan_pdd']; ?>'>
                                                    <?= $d_jurusan_pdd['nama_jurusan_pdd']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    <?php
                                    } else {
                                    ?>
                                        <b><i>Data Jurusan Tidak Ada</i></b>
                                    <?php
                                    }
                                    ?>
                                    <br>

                                    Jenjang : <span class="text-danger">*</span><br>
                                    <?php
                                    $sql_jenjang_pdd = "SELECT * FROM tb_jenjang_pdd order by nama_jenjang_pdd ASC";

                                    $q_jenjang_pdd = $conn->query($sql_jenjang_pdd);
                                    $r_jenjang_pdd = $q_jenjang_pdd->rowCount();

                                    if ($r_jenjang_pdd > 0) {
                                    ?>
                                        <select class="form-control text-center" name="id_jenjang_pdd" required>
                                            <option value="">-- Pilih Jenjang --</option>
                                            <?php
                                            while ($d_jenjang_pdd = $q_jenjang_pdd->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value='<?= $d_jenjang_pdd['id_jenjang_pdd']; ?>'>
                                                    <?= $d_jenjang_pdd['nama_jenjang_pdd']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    <?php
                                    } else {
                                    ?>
                                        <b><i>Data Jenjang Tidak Ada</i></b>
                                    <?php
                                    }
                                    ?>
                                    <br>

                                    Spesifikasi : <span class="text-danger">*</span><br>
                                    <?php
                                    $sql_spesifikasi_pdd = "SELECT * FROM tb_spesifikasi_pdd order by nama_spesifikasi_pdd ASC";

                                    $q_spesifikasi_pdd = $conn->query($sql_spesifikasi_pdd);
                                    $r_spesifikasi_pdd = $q_spesifikasi_pdd->rowCount();

                                    if ($r_spesifikasi_pdd > 0) {
                                    ?>
                                        <select class="form-control text-center" name="id_spesifikasi_pdd" required>
                                            <option value="">-- Pilih spesifikasi --</option>
                                            <?php
                                            while ($d_spesifikasi_pdd = $q_spesifikasi_pdd->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value='<?= $d_spesifikasi_pdd['id_spesifikasi_pdd']; ?>'>
                                                    <?= $d_spesifikasi_pdd['nama_spesifikasi_pdd']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    <?php
                                    } else {
                                    ?>
                                        <b><i>Data Spesifikasi Tidak Ada</i></b>
                                    <?php
                                    }
                                    ?>
                                    <br>

                                    Pilihan : <span class="text-danger">*</span><br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pilih_tarif" value="1" required>
                                        <label class="form-check-label">
                                            Harus
                                        </label><br>
                                        <input class="form-check-input" type="radio" name="pilih_tarif" value="2">
                                        <label class="form-check-label">
                                            Pilih Salah Satu
                                        </label><br>
                                        <input class="form-check-input" type="radio" name="pilih_tarif" value="3">
                                        <label class="form-check-label">
                                            Opsional
                                        </label>
                                    </div>
                                    Keterangan : <br>
                                    <textarea name="ket_tarif" class="form-control"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-success btn-sm" name="tambah_tarif" value="Tambah">
                                    <input class="btn btn-outline-dark btn-sm" type="button" data-dismiss="modal" value="Kembali">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- tambah satuan tarif -->
                <a class="btn btn-outline-success btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ruler-horizontal"></i> Satuan
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class='dropdown-item' href='#' data-toggle='modal' data-target='#ish_i_m'>
                        Tambah Satuan
                    </a>
                    <a class='dropdown-item' href='?trf&dts'>
                        Daftar Satuan
                    </a>
                </div>
            </div>

            <!-- modal santuan tarif  -->
            <div class="modal fade" id="ish_i_m">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="">
                            <div class="modal-header">
                                Tambah Satuan Tarif :
                            </div>
                            <div class="modal-body">
                                Nama Satuan Tarif : <span class="text-danger">*</span><br>
                                <input class="form-control" name="nama_tarif_satuan" required><br>
                                Keterangan Tarif : <span class="text-danger">*</span><br>
                                <input class="form-control" name="ket_tarif_satuan"><br>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-success btn-sm" name="tambah_tarif_satuan" value="Tambah">
                                <input class="btn btn-outline-dark btn-sm" type="button" data-dismiss="modal" value="Kembali">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <?php

                // data satuan Tarif
                if (isset($_GET['dts'])) {
                ?>
                    <table class="table table-striped" id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Satuan Tarif</th>
                                <th scope="col">Keterangan tarif</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql_tarif_satuan = "SELECT * FROM tb_tarif_satuan ORDER BY nama_tarif_satuan ASC";

                            $q_tarif_satuan = $conn->query($sql_tarif_satuan);
                            $r_tarif_satuan = $q_tarif_satuan->rowCount();

                            $no = 1;
                            while ($d_tarif_satuan = $q_tarif_satuan->fetch(PDO::FETCH_ASSOC)) {

                            ?>
                                <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td><?= $d_tarif_satuan['nama_tarif_satuan']; ?></td>
                                    <td><?= $d_tarif_satuan['ket_tarif_satuan']; ?></td>
                                    <td>
                                        <a title="Ubah" class='btn btn-primary btn-sm' href='#' data-toggle='modal' data-target='<?= "#dts_u_m" . $d_tarif_satuan['id_tarif_satuan']; ?>'>
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a title="Hapus" class='btn btn-danger btn-sm' href='#' data-toggle='modal' data-target='<?= "#dts_d_m" . $d_tarif_satuan['id_tarif_satuan']; ?>'>
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- modal ubah Satuan Tarif  -->
                                <div class="modal fade" id="<?= "dts_u_m" . $d_tarif_satuan['id_tarif_satuan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="post" action="" class="form-group">
                                                <div class="modal-header">
                                                    <h5>Ubah Tarif :</h5>
                                                </div>
                                                <div class="modal-body">

                                                    <!-- id_tarif_satuan -->
                                                    <input name="id_tarif_satuan" value="<?= $d_tarif_satuan['id_tarif_satuan']; ?>" hidden>

                                                    Nama Tarif Satuan : <span class="text-danger">*</span><br>
                                                    <input class="form-control" name="nama_tarif_satuan" value="<?= $d_tarif_satuan['nama_tarif_satuan']; ?>" required><br>

                                                    Keterangan Tarif Satuan : <br>
                                                    <input class="form-control" name="ket_tarif_satuan" value="<?= $d_tarif_satuan['ket_tarif_satuan']; ?>"><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <br>
                                                    <input type="submit" class="btn btn-success btn-sm" name="ubah_tarif_satuan" value="Ubah">
                                                    <input type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal" value="Kembali">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- modal hapus satuan tarif  -->
                                <div class="modal fade" id="<?= "dts_d_m" . $d_tarif_satuan['id_tarif_satuan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="post" action="">
                                                <div class="modal-header">
                                                    <h5>Hapus Data</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <h6><b><?= $d_tarif_satuan['nama_tarif_satuan']; ?></b></h6>
                                                    <input name="id_tarif_satuan" value="<?= $d_tarif_satuan['id_tarif_satuan']; ?>" hidden>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger btn-sm" name="hapus_tarif_satuan">Ya</button>
                                                    <button class="btn btn-outline-dark btn-sm" type="button" data-dismiss="modal">Tidak</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                }
                //data tarif
                else {
                ?>
                    <table class="table table-striped" id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col" width="150px">Nama Tarif</th>
                                <th scope="col" width="120px">Satuan Tarif</th>
                                <th scope="col">Jumlah Tarif</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Jenjang</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql_tarif = "SELECT * FROM tb_tarif 
                            JOIN tb_jurusan_pdd ON tb_tarif.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd
                            JOIN tb_jenjang_pdd ON tb_tarif.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd
                            JOIN tb_spesifikasi_pdd ON tb_tarif.id_spesifikasi_pdd = tb_spesifikasi_pdd.id_spesifikasi_pdd
                            JOIN tb_tarif_satuan ON tb_tarif.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan
                            WHERE tb_tarif.status_tarif = 'y'
                            ORDER BY tb_tarif.id_jurusan_pdd ASC
                            ";

                            $q_tarif = $conn->query($sql_tarif);
                            $r_tarif = $q_tarif->rowCount();

                            $no = 1;
                            while ($d_tarif = $q_tarif->fetch(PDO::FETCH_ASSOC)) {

                            ?>
                                <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td><?= $d_tarif['nama_tarif']; ?></td>
                                    <td><?= $d_tarif['nama_tarif_satuan']; ?></td>
                                    <td><?= "Rp " . number_format($d_tarif['jumlah_tarif'], 0, ",", "."); ?></td>
                                    <td><?= $d_tarif['nama_jurusan_pdd']; ?></td>
                                    <td>
                                        <?php
                                        if ($d_tarif['nama_jenjang_pdd'] == "-- Lainnya --") {
                                            echo "-";
                                        } else {
                                            echo $d_tarif['nama_jenjang_pdd'];
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a title="Ubah" class='btn btn-primary btn-sm' href='#' data-toggle='modal' data-target='<?= "#trf_u_m" . $d_tarif['id_tarif']; ?>'>
                                            <i class="fas fa-edit"></i> UBAH
                                        </a>
                                        <a title="Hapus" class='btn btn-danger btn-sm' href='#' data-toggle='modal' data-target='<?= "#trf_d_m" . $d_tarif['id_tarif']; ?>'>
                                            <i class="fas fa-trash-alt"></i> HAPUS
                                        </a>
                                    </td>
                                </tr>

                                <!-- modal ubah Tarif  -->
                                <div class="modal fade" id="<?= "trf_u_m" . $d_tarif['id_tarif']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="post" action="" class="form-group">
                                                <div class="modal-header">
                                                    <h5>Ubah Tarif :</h5>
                                                </div>
                                                <div class="modal-body">

                                                    <!-- id_tarif -->
                                                    <input name="id_tarif" value="<?= $d_tarif['id_tarif']; ?>" hidden>

                                                    Nama Tarif : <span class="text-danger">*</span><br>
                                                    <input class="form-control" name="nama_tarif" value="<?= $d_tarif['nama_tarif']; ?>" required><br>

                                                    Satuan Tarif : <span class="text-danger">*</span><br>
                                                    <?php
                                                    $sql_tarif_satuan = "SELECT * FROM tb_tarif_satuan ORDER BY nama_tarif_satuan ASC";
                                                    $q_tarif_satuan = $conn->query($sql_tarif_satuan);
                                                    $r_tarif_satuan = $q_tarif_satuan->rowCount();
                                                    if ($r_tarif_satuan > 0) {
                                                    ?>
                                                        <select class="form-control text-center" name="id_tarif_satuan" required>
                                                            <option value="">-- Pilih Jenis Tarif --</option>
                                                            <?php
                                                            while ($d_tarif_satuan = $q_tarif_satuan->fetch(PDO::FETCH_ASSOC)) {
                                                                if ($d_tarif['id_tarif_satuan'] == $d_tarif_satuan['id_tarif_satuan']) {
                                                                    $selected = "selected";
                                                                } else {
                                                                    $selected = "";
                                                                }
                                                            ?>
                                                                <option value='<?= $d_tarif_satuan['id_tarif_satuan']; ?>' <?= $selected; ?>>
                                                                    <?= $d_tarif_satuan['nama_tarif_satuan']; ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <b><i>Data Satuan Tarif Tidak Ada</i></b>
                                                    <?php
                                                    }
                                                    ?>
                                                    <br>

                                                    Tipe Tarif: <span class="text-danger">*</span><br>
                                                    <select class="form-control text-center" id="ubahTipeTarif" name="tipe_tarif" onchange="ubah_tipeTarif()" required>
                                                        <option value="">-- Pilih --</option>
                                                        <?php
                                                        $cek1 = '';
                                                        $cek2 = '';
                                                        $cek3 = '';
                                                        $cek4 = '';
                                                        $cek5 = '';
                                                        $cek6 = '';
                                                        if ($d_tarif['tipe_tarif'] == 'SEKALI') {
                                                            $cek1 = 'selected';
                                                        } elseif ($d_tarif['tipe_tarif'] == 'INPUT') {
                                                            $cek2 = 'selected';
                                                        } elseif ($d_tarif['tipe_tarif'] == 'HARI-') {
                                                            $cek3 = 'selected';
                                                        } elseif ($d_tarif['tipe_tarif'] == 'HARI+') {
                                                            $cek4 = 'selected';
                                                        } elseif ($d_tarif['tipe_tarif'] == 'MINGGUAN') {
                                                            $cek5 = 'selected';
                                                        } elseif ($d_tarif['tipe_tarif'] == '-- LAINNYA --') {
                                                            $cek6 = 'selected';
                                                        }

                                                        ?>
                                                        <option value="SEKALI" <?= $cek1; ?>>Sekali</option>
                                                        <option value="INPUT" <?= $cek2; ?>>Diinput Manual</option>
                                                        <option value="HARI-" <?= $cek3; ?>>Harian Tidak Termasuk Sabtu Minggu</option>
                                                        <option value="HARI+" <?= $cek4; ?>>Harian Termasuk Sabtu Minggu</option>
                                                        <option value="MINGGUAN" <?= $cek5; ?>>Mingguan</option>
                                                        <option value="-- LAINNYA --" <?= $cek6; ?>>-- LAINNYA --</option>
                                                    </select>
                                                    <br>

                                                    <div id="ubahFrekKuanTarif"></div>

                                                    Jumlah Tarif : <i style='font-size:12px;'>(Rp)</i><span class="text-danger">*</span><br>
                                                    <input class="form-control" name="jumlah_tarif" type="number" min="1" value="<?= $d_tarif['jumlah_tarif']; ?>" required>
                                                    <i style='font-size:12px;'>Isian hanya berupa angka</i><br><br>

                                                    Jenis Tarif : <span class="text-danger">*</span><br>
                                                    <?php
                                                    $sql_tarif_jenis = "SELECT * FROM tb_tarif_jenis order by nama_tarif_jenis ASC";
                                                    $q_tarif_jenis = $conn->query($sql_tarif_jenis);
                                                    $r_tarif_jenis = $q_tarif_jenis->rowCount();
                                                    if ($r_tarif_jenis > 0) {
                                                    ?>
                                                        <select class="form-control text-center" name="id_tarif_jenis" required>
                                                            <option value="">-- Pilih Jenis Tarif --</option>
                                                            <?php
                                                            while ($d_tarif_jenis = $q_tarif_jenis->fetch(PDO::FETCH_ASSOC)) {
                                                                if ($d_tarif['id_tarif_jenis'] == $d_tarif_jenis['id_tarif_jenis']) {
                                                                    $selected = "selected";
                                                                } else {
                                                                    $selected = "";
                                                                }
                                                            ?>
                                                                <option value='<?= $d_tarif_jenis['id_tarif_jenis']; ?>' <?= $selected; ?>>
                                                                    <?= $d_tarif_jenis['nama_tarif_jenis']; ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <b><i>Data Jenis Tarif Tidak Ada</i></b>
                                                    <?php
                                                    }
                                                    ?>
                                                    <br>

                                                    Jurusan : <span class="text-danger">*</span><br>
                                                    <?php
                                                    $sql_jurusan_pdd = "SELECT * FROM tb_jurusan_pdd order by nama_jurusan_pdd ASC";
                                                    $q_jurusan_pdd = $conn->query($sql_jurusan_pdd);
                                                    $r_jurusan_pdd = $q_jurusan_pdd->rowCount();
                                                    if ($r_jurusan_pdd > 0) {
                                                    ?>
                                                        <select class="form-control text-center" name="id_jurusan_pdd" required>
                                                            <option value="">-- Pilih Jenis Tarif --</option>
                                                            <?php
                                                            while ($d_jurusan_pdd = $q_jurusan_pdd->fetch(PDO::FETCH_ASSOC)) {
                                                                if ($d_tarif['id_jurusan_pdd'] == $d_jurusan_pdd['id_jurusan_pdd']) {
                                                                    $selected = "selected";
                                                                } else {
                                                                    $selected = "";
                                                                }
                                                            ?>
                                                                <option value='<?= $d_jurusan_pdd['id_jurusan_pdd']; ?>' <?= $selected; ?>>
                                                                    <?= $d_jurusan_pdd['nama_jurusan_pdd']; ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <b><i>Data Jurusan Tidak Ada</i></b>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div id="u_i_id_jurusan_pdd<?= $d_tarif['id_tarif']; ?>">
                                                    </div><br>

                                                    Jenjang : <span class="text-danger">*</span><br>
                                                    <?php
                                                    $sql_jenjang_pdd = "SELECT * FROM tb_jenjang_pdd order by nama_jenjang_pdd ASC";
                                                    $q_jenjang_pdd = $conn->query($sql_jenjang_pdd);
                                                    $r_jenjang_pdd = $q_jenjang_pdd->rowCount();
                                                    if ($r_jenjang_pdd > 0) {
                                                    ?>
                                                        <select class="form-control text-center" name="id_jenjang_pdd" required>
                                                            <option value="">-- Pilih Jenis Tarif --</option>
                                                            <?php
                                                            while ($d_jenjang_pdd = $q_jenjang_pdd->fetch(PDO::FETCH_ASSOC)) {
                                                                if ($d_tarif['id_jenjang_pdd'] == $d_jenjang_pdd['id_jenjang_pdd']) {
                                                                    $selected = "selected";
                                                                } else {
                                                                    $selected = "";
                                                                }
                                                            ?>
                                                                <option value='<?= $d_jenjang_pdd['id_jenjang_pdd']; ?>' <?= $selected; ?>>
                                                                    <?= $d_jenjang_pdd['nama_jenjang_pdd']; ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <b><i>Data jenjang Tidak Ada</i></b>
                                                    <?php
                                                    }
                                                    ?>
                                                    <br>

                                                    Spesifikasi : <span class="text-danger">*</span><br>
                                                    <?php
                                                    $sql_spesifikasi_pdd = "SELECT * FROM tb_spesifikasi_pdd order by nama_spesifikasi_pdd ASC";
                                                    $q_spesifikasi_pdd = $conn->query($sql_spesifikasi_pdd);
                                                    $r_spesifikasi_pdd = $q_spesifikasi_pdd->rowCount();
                                                    if ($r_spesifikasi_pdd > 0) {
                                                    ?>
                                                        <select class="form-control text-center" name="id_spesifikasi_pdd" required>
                                                            <option value="">-- Pilih Jenis Tarif --</option>
                                                            <?php
                                                            while ($d_spesifikasi_pdd = $q_spesifikasi_pdd->fetch(PDO::FETCH_ASSOC)) {
                                                                if ($d_tarif['id_spesifikasi_pdd'] == $d_spesifikasi_pdd['id_spesifikasi_pdd']) {
                                                                    $selected = "selected";
                                                                } else {
                                                                    $selected = "";
                                                                }
                                                            ?>
                                                                <option value='<?= $d_spesifikasi_pdd['id_spesifikasi_pdd']; ?>' <?= $selected; ?>>
                                                                    <?= $d_spesifikasi_pdd['nama_spesifikasi_pdd']; ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <b><i>Data spesifikasi Tidak Ada</i></b>
                                                    <?php
                                                    }
                                                    ?>
                                                    <br>

                                                    Pilihan : <span class="text-danger">*</span><br>
                                                    <div class="form-check">
                                                        <?php
                                                        $pilih_tarif_1 = '';
                                                        $pilih_tarif_2 = '';
                                                        $pilih_tarif_3 = '';
                                                        if ($d_tarif['pilih_tarif'] == 1) {
                                                            $pilih_tarif_1 = "checked";
                                                        } elseif ($d_tarif['pilih_tarif'] == 2) {
                                                            $pilih_tarif_2 = "checked";
                                                        } elseif ($d_tarif['pilih_tarif'] == 3) {
                                                            $pilih_tarif_3 = "checked";
                                                        }
                                                        ?>
                                                        <input class="form-check-input" type="radio" name="pilih_tarif" value="1" required <?= $pilih_tarif_1; ?>>
                                                        <label class="form-check-label">
                                                            Harus
                                                        </label><br>
                                                        <input class="form-check-input" type="radio" name="pilih_tarif" value="2" <?= $pilih_tarif_2; ?>>
                                                        <label class="form-check-label">
                                                            Pilih Salah Satu
                                                        </label><br>
                                                        <input class="form-check-input" type="radio" name="pilih_tarif" value="3" <?= $pilih_tarif_3; ?>>
                                                        <label class="form-check-label">
                                                            Opsional
                                                        </label>
                                                    </div>

                                                    Keterangan : <br>
                                                    <textarea class="form-control" name="ket_tarif"><?= $d_tarif['ket_tarif'] ?></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <input name="cari" value="cs" hidden>
                                                    <input type="submit" class="btn btn-success btn-sm" name="ubah_tarif" value="Ubah">
                                                    <input type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal" value="Kembali">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- modal hapus Tarif  -->
                                <div class="modal fade" id="<?= "trf_d_m" . $d_tarif['id_tarif']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="post" action="">
                                                <div class="modal-header">
                                                    <h5>Hapus Data</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <h6><b><?= $d_tarif['nama_tarif']; ?></b></h6>
                                                    <input name="id_tarif" value="<?= $d_tarif['id_tarif']; ?>" hidden>
                                                    <input name="cari" value="cs" hidden>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger btn-sm" name="hapus_tarif">Ya</button>
                                                    <button class="btn btn-outline-dark btn-sm" type="button" data-dismiss="modal">Tidak</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    function tambah_tipeTarif() {
        if ($('#tambahTipeTarif').val() == '-- LAINNYA --') {
            console.log("TambahTarif Lainnya");
            $('#tambahFrekKuanTarif').append(
                "<div class='row'>" +
                "<div class='col'>" +
                "<input type='number' class='form-control' placeHolder='Isikan Frekuensi Tarif' name='frekuensi_tarif'>" +
                "</div>" +
                "<div class='col'>" +
                "<input type='number' class='form-control' placeHolder='Isikan Kuantitas Tarif' name='kuantitas_tarif'>" +
                "</div>" +
                "</div>" +
                "<br>").focus();
        } else {
            console.log("Tidak Pilih Institusi Lainnya");
            $('#tambahFrekKuanTarif').empty();
        }
    }

    function ubah_tipeTarif() {
        if ($('#ubahTipeTarif').val() == '-- LAINNYA --') {
            console.log("Ubah Tarif Lainnya");
            $('#tambahFrekKuanTarif').append(
                "<div class='row'>" +
                "<div class='col'>" +
                "<input type='number' class='form-control' placeHolder='Isikan Frekuensi Tarif' name='frekuensi_tarif'>" +
                "</div>" +
                "<div class='col'>" +
                "<input type='number' class='form-control' placeHolder='Isikan Kuantitas Tarif' name='kuantitas_tarif'>" +
                "</div>" +
                "</div>" +
                "<br>").focus();
        } else {
            console.log("Tidak Pilih Institusi Lainnya");
            $('#tambahFrekKuanTarif').empty();
        }
    }
</script>
<?php
if (isset($_POST['tambah_tarif'])) {

    $sql_insert_tarif =  "INSERT INTO tb_tarif (
        nama_tarif,
        id_tarif_satuan,
        jumlah_tarif,
        tipe_tarif,
        frekuensi_tarif,
        kuantitas_tarif,
        id_jurusan_pdd,
        id_jenjang_pdd,
        id_spesifikasi_pdd,
        id_tarif_jenis,
        ket_tarif,
        pilih_tarif,
        tgl_tambah_tarif,
        status_tarif
        ) VALUES (
            '" . $_POST['nama_tarif'] . "',
            '" . $_POST['id_tarif_satuan'] . "',
            '" . $_POST['jumlah_tarif'] . "',
            '" . $_POST['tipe_tarif'] . "',
            '" . $_POST['frekuensi_tarif'] . "',
            '" . $_POST['kuantitas_tarif'] . "',
            '" . $_POST['id_jurusan_pdd'] . "',
            '" . $_POST['id_jenjang_pdd'] . "',
            '" . $_POST['id_spesifikasi_pdd'] . "',
            '" . $_POST['id_tarif_jenis'] . "',
            '" . $_POST['ket_tarif'] . "',
            '" . $_POST['pilih_tarif'] . "',
            '" . date('Y-m-d', time()) . "',
            'y'
            )";

    // echo $sql_insert_tarif . "<br>";
    $conn->query($sql_insert_tarif);

?>
    <script>
        document.location.href = "?trf";
    </script>
<?php
} elseif (isset($_POST['tambah_tarif_satuan'])) {

    $sql_insert_tarif =  "INSERT INTO tb_tarif_satuan (
        nama_tarif_satuan,
        ket_tarif_satuan
        ) VALUES (
            '" . $_POST['nama_tarif_satuan'] . "',
            '" . $_POST['ket_tarif_satuan'] . "'
            )";

    // echo $sql_insert_tarif . "<br>";
    $conn->query($sql_insert_tarif);

?>
    <script>
        document.location.href = "?trf&dts";
    </script>
<?php
} elseif (isset($_POST['ubah_tarif'])) {
    $sql_ubah = "UPDATE `tb_tarif` SET 
    `nama_tarif` = '" . $_POST['nama_tarif'] . "',
    `id_tarif_satuan` = '" . $_POST['id_tarif_satuan'] . "',
    `jumlah_tarif` = '" . $_POST['jumlah_tarif'] . "',
    `frekuensi_tarif` = '" . $_POST['frekuensi_tarif'] . "',
    `tipe_tarif` = '" . $_POST['tipe_tarif'] . "',
    `id_tarif_jenis` = '" . $_POST['id_tarif_jenis'] . "',
    `id_jurusan_pdd` = '" . $_POST['id_jurusan_pdd'] . "',
    `id_jenjang_pdd` = '" . $_POST['id_jenjang_pdd'] . "',
    `id_spesifikasi_pdd` = '" . $_POST['id_spesifikasi_pdd'] . "',
    `tgl_tarif` = '" . date('Y-m-d', time()) . "',
    `ket_tarif` = '" . $_POST['ket_tarif'] . "',
    `pilih_tarif` = '" . $_POST['pilih_tarif'] . "'
    WHERE `tb_tarif`.`id_tarif` = " . $_POST['id_tarif'];
    // echo $sql_ubah . "<br>";
    $conn->query($sql_ubah);
?>
    <script>
        document.location.href = "?trf";
    </script>
<?php
} elseif (isset($_POST['ubah_tarif_satuan'])) {
    $sql_ubah = "UPDATE `tb_tarif_satuan` SET 
    `nama_tarif_satuan` = '" . $_POST['nama_tarif_satuan'] . "',
    `ket_tarif_satuan` = '" . $_POST['ket_tarif_satuan'] . "'
    WHERE `id_tarif_satuan` = " . $_POST['id_tarif_satuan'];

    // echo $sql_ubah;
    $conn->query($sql_ubah);
?>
    <script>
        document.location.href = "?trf&dts";
    </script>
<?php
} elseif (isset($_POST['hapus_tarif'])) {
    $conn->query("DELETE FROM `tb_tarif` WHERE `id_tarif` = " . $_POST['id_tarif']);

?>
    <script>
        document.location.href = "?trf";
    </script>
<?php
} elseif (isset($_POST['hapus_tarif_satuan'])) {
    $conn->query("DELETE FROM `tb_tarif_satuan` WHERE `id_tarif_satuan` = " . $_POST['id_tarif_satuan']);

?>
    <script>
        document.location.href = "?trf&dts";
    </script>
<?php
}
?>