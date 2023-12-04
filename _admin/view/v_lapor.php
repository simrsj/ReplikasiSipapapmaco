<?php
if (isset($_POST['tambah_lapor'])) {


    $no = 1;
    $sql = "SELECT id_lapor FROM tb_lapor ORDER BY id_lapor ASC";
    $q = $conn->query($sql);
    while ($d = $q->fetch(PDO::FETCH_ASSOC)) {
        if ($no != $d['id_lapor']) {
            $no = $d['id_lapor'] + 1;
            break;
        }
        $no++;
    }

    // echo "<pre>";
    // print_r($_FILES);
    // echo "</pre>";
    $link_file_lapor = '';
    if ($_FILES['file_lapor']['size'] > 0) {
        //ubah Nama File PDF
        $_FILES['file_lapor']['name'] = "lapor_" . $no . "_" . date('Y-m-d', time()) . "." . substr($_FILES['file_lapor']['type'], 6);

        // echo "<pre>";
        // print_r($_FILES);
        // echo "</pre>";

        //alamat file surat masuk
        $alamat_unggah = "./_file/lapor";

        //pembuatan alamat bila tidak ada
        if (!is_dir($alamat_unggah)) {
            mkdir($alamat_unggah, 0777, $rekursif = true);
        }

        //unggah surat dan data praktik
        if (!is_null($_FILES['file_lapor'])) {
            $file_lapor = (object) @$_FILES['file_lapor'];

            //mulai unggah file surat praktik
            if ($file_lapor->size > 1000 * 1000) {
                echo "
                <script>
                    alert('File Lapor Harus dibawah 1 Mb');
                    document.location.href = '?lapor';
                </script>
                ";
            } elseif (substr($_FILES['file_lapor']['type'], 6) != ('png' || 'gif' || 'jpeg' || 'jpg')) {
                echo "
                <script>
                    alert('File Lapor Harus .png, .gif, jpeg, jpg');
                    document.location.href = '?lapor';
                </script>
                    ";
            } else {
                $unggah_file_lapor = move_uploaded_file(
                    $file_lapor->tmp_name,
                    "{$alamat_unggah}/{$file_lapor->name}"
                );
                $link_file_lapor = "{$alamat_unggah}/{$file_lapor->name}";
            }
        } else {
            $link_file_lapor = "";
        }
    }
    $sql_tambah_lapor = "INSERT INTO tb_lapor (
        id_lapor,
        judul_lapor,
        deskripsi_lapor,
        level_lapor, 
        tgl_lapor,
        nama_lapor,
        link_lapor,
        status_lapor,
        file_lapor
    ) VALUES (
        '" . $no . "',
        '" . $_POST['judul_lapor'] . "',
        '" . $_POST['deskripsi_lapor'] . "',
        '" . $_POST['level_lapor'] . "',
        '" . date('Y-m-d', time()) . "',
        '" . $_POST['nama_lapor'] . "',
        '" . $_POST['link_lapor'] . "',
        'cek',
        '" . $link_file_lapor . "'
    )";

    // echo $sql_tambah_lapor . "<br>";
    $conn->query($sql_tambah_lapor);
    echo "
    <script>
        alert('Data Lapor Sudah Tersimpan');
        document.location.href = '?lapor';
    </script>
    ";
} elseif (isset($_POST['ubah_lapor'])) {

    //jika foto diupload
    if ($_FILES['file_lapor']['size'] > 0) {
        //ubah Nama File PDF
        $_FILES['file_lapor']['name'] = "lapor_" . $_POST['id_lapor'] . "_" . date('Y-m-d', time()) . "." . substr($_FILES['file_lapor']['type'], 6);

        // echo "<pre>";
        // print_r($_FILES);
        // echo "</pre>";

        //alamat file surat masuk
        $alamat_unggah = "./_file/lapor";

        //pembuatan alamat bila tidak ada
        if (!is_dir($alamat_unggah)) {
            mkdir($alamat_unggah, 0777, $rekursif = true);
        }

        //unggah surat dan data praktik
        if (!is_null($_FILES['file_lapor'])) {
            $file_lapor = (object) @$_FILES['file_lapor'];

            //mulai unggah file surat praktik
            if ($file_lapor->size > 1000 * 1000) {
                echo "
                <script>
                    alert('File Surat Harus dibawah 1 Mb');
                    document.location.href = '?lapor';
                </script>
                ";
            } elseif (substr($_FILES['file_lapor']['type'], 6) != ('png' || 'gif' || 'jpeg' || 'jpg')) {
                echo "
                <script>
                    alert('File Surat Harus .png, .gif, jpeg, jpg');
                    document.location.href = '?lapor';
                </script>
                    ";
            } else {
                $unggah_file_lapor = move_uploaded_file(
                    $file_lapor->tmp_name,
                    "{$alamat_unggah}/{$file_lapor->name}"
                );
                $link_file_lapor = "{$alamat_unggah}/{$file_lapor->name}";
            }
        } else {
            $link_file_lapor = "";
        }
    }

    //jika foto tidak diupload, ambil dari database

    //jika logo tidak file_lapor ambil dari sebelumya
    if ($_FILES['file_lapor']['size'] == 0) {
        $sql = "SELECT file_lapor FROM tb_lapor WHERE id_lapor='" . $_POST['id_lapor'] . "'";
        $d = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
        $link_file_lapor = $d['file_lapor'];
    }

    $sql_ubah = "UPDATE tb_lapor SET
        judul_lapor = '" . $_POST['judul_lapor'] . "',
        deskripsi_lapor = '" . $_POST['deskripsi_lapor'] . "',
        level_lapor = '" . $_POST['level_lapor'] . "',
        nama_lapor = '" . $_POST['nama_lapor'] . "',
        link_lapor = '" . $_POST['link_lapor'] . "',
        file_lapor = '" . $link_file_lapor . "'
        WHERE id_lapor ='" . $_POST['id_lapor']  . "'";
    // echo $sql_ubah . "<br>";
    $conn->query($sql_ubah);

    echo "
    <script>
        alert('Data lapor sudah diubah');
        document.location.href = '?lapor';
    </script>
    ";
} elseif (isset($_POST['hapus_lapor'])) {
    $conn->query("DELETE FROM `tb_lapor` WHERE `id_lapor` = " . $_POST['id_lapor']);
    echo "
    <script>
        alert('Data lapor sudah dihapus!');
        document.location.href = '?lapor';
    </script>
    ";
} elseif (isset($_POST['ubah_status'])) {
    $sql_ubah = "UPDATE tb_lapor SET
        status_lapor = '" . $_POST['ubah_status'] . "'
        WHERE id_lapor ='" . $_POST['id_lapor']  . "'";
    // echo $sql_ubah . "<br>";
    $conn->query($sql_ubah);

    echo "
    <script>
        alert('Status lapor sudah diubah');
        document.location.href = '?lapor';
    </script>
    ";
} else {
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="h3 mb-2 text-gray-800">Daftar Laporan</h1>
            </div>
            <div class="col-lg-2">
                <a class='btn btn-outline-success btn-sm' href='#' data-toggle="modal" data-target="#tambah_lapor">
                    <i class="fas fa-plus"></i> Tambah
                </a>
                <!-- modal tambah akun -->
                <div class="modal fade" id="tambah_lapor" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="form-group" method="POST" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Lapor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <b>Nama Pelapor : </b><br>
                                    <input class="form-control" type="text" name="nama_lapor" required><br>
                                    <b>Judul Laporan : </b><br>
                                    <input class="form-control" type="text" name="judul_lapor" required><br>
                                    <b>Deskripsi Laporan : </b><br>
                                    <textarea class="form-control" name="deskripsi_lapor"></textarea><br>
                                    <b>Link <i class="font-weight-bold">ERROR</i> : </b><br>
                                    <textarea class="form-control" name="link_lapor"></textarea><br>
                                    <i>Screenshot ERROR : </i><br>
                                    <input type="file" name="file_lapor" accept="image/png, image/gif, image/jpeg, image/jpg"><br><br>
                                    <b>Level : </b><br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal">Kembali</button>
                                    <button type="submit" class="btn btn-primary btn-sm" name="tambah_lapor">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <?php
                $sql_lapor = "SELECT * FROM tb_lapor ORDER BY tgl_lapor ASC";

                $q_lapor = $conn->query($sql_lapor);
                $r_lapor = $q_lapor->rowCount();

                if ($r_lapor > 0) {
                ?>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal Lapor</th>
                                    <th scope="col">Nama Pelapor</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Level Pelapor</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Detail</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                <?php
                                $no = 1;
                                while ($d_lapor = $q_lapor->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= tanggal_minimal($d_lapor['tgl_lapor']); ?></td>
                                        <td><?= $d_lapor['nama_lapor']; ?></td>
                                        <td><?= $d_lapor['judul_lapor']; ?></td>
                                        <td>
                                            <?php
                                            if ($d_lapor['level_lapor'] == 'rendah') {
                                            ?>
                                                <span class="badge badge-success text-md">RENDAH</span>
                                            <?php
                                            } elseif ($d_lapor['level_lapor'] == 'sedang') {
                                            ?>
                                                <span class="badge badge-warning text-md">SEDANG</span>
                                            <?php
                                            } elseif ($d_lapor['level_lapor'] == 'tinggi') {
                                            ?>
                                                <span class="badge badge-danger text-md">TINGGI</span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($d_lapor['status_lapor'] == 'CEK') {
                                            ?>
                                                <span class="badge badge-warning text-md">CEK</span>
                                            <?php
                                            } elseif ($d_lapor['status_lapor'] == 'PROSES') {
                                            ?>
                                                <span class="badge badge-primary text-md">PROSES</span>
                                            <?php
                                            } elseif ($d_lapor['status_lapor'] == 'SELESAI') {
                                            ?>
                                                <span class="badge badge-success text-md">SELESAI</span>
                                            <?php
                                            } else {
                                            ?>
                                                <span class="badge badge-danger text-md">ERROR</span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <!-- tombol ubah lapor -->
                                            <a href="#" class="btn btn-info btn-sm" title="Lihat Detail" data-toggle="modal" data-target="#lihat_<?= $d_lapor['id_lapor']; ?>">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>

                                            <!-- modal cek -->
                                            <div class="modal fade" id="lihat_<?= $d_lapor['id_lapor']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-7 text-center">
                                                                    <img src="<?= $d_lapor['file_lapor']; ?>" class="img-fluid" alt="Responsive image"><br>
                                                                    <a href="<?= $d_lapor['file_lapor']; ?>" class="btn btn-success btn-sm" target="_blank"><i class="fas fa-search"></i> Perbesar</a>

                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <fieldset class="fieldset">
                                                                        <legend class="legend-fieldset">Rincian</legend>
                                                                        <b>Judul : </b><br>
                                                                        <?= $d_lapor['judul_lapor']; ?><br><br>
                                                                        <b>Link ERROR : </b><br>
                                                                        <?= $d_lapor['link_lapor']; ?><br><br>
                                                                        <b>Deskripsi : </b><br>
                                                                        <?= $d_lapor['deskripsi_lapor']; ?><br><br>
                                                                        <form method="post">
                                                                            <input name="id_lapor" value="<?= $d_lapor['id_lapor']; ?>" hidden>
                                                                            <input class="btn btn-warning btn-sm" type="submit" name="ubah_status" value="CEK">
                                                                            <input class="btn btn-primary btn-sm" type="submit" name="ubah_status" value="PROSES">
                                                                            <input class="btn btn-success btn-sm" type="submit" name="ubah_status" value="SELESAI">
                                                                        </form>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Kembali</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>

                                            <!-- tombol ubah lapor -->
                                            <a href="#" class="btn btn-primary btn-sm" title="Ubah Akun" data-toggle="modal" data-target="#ubah_<?= $d_lapor['id_lapor']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- modal ubah lapor -->
                                            <div class="modal fade" id="ubah_<?= $d_lapor['id_lapor']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form class="form-group" method="POST" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Ubah Lapor</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php
                                                                $sql_lapor_ubah = "SELECT * FROM tb_lapor WHERE id_lapor = '" . $d_lapor['id_lapor'] . "'";

                                                                $q_lapor_ubah = $conn->query($sql_lapor_ubah);
                                                                $d_lapor_ubah = $q_lapor_ubah->fetch(PDO::FETCH_ASSOC);
                                                                ?>
                                                                <b>Nama Pelapor : </b><br>
                                                                <input class="form-control" type="text" name="nama_lapor" value="<?= $d_lapor_ubah['nama_lapor']; ?>" required><br>
                                                                <b>Judul Laporan : </b><br>
                                                                <input class="form-control" type="text" name="judul_lapor" value="<?= $d_lapor_ubah['judul_lapor']; ?>" required><br>
                                                                <b>Deskripsi Laporan : </b><br>
                                                                <textarea class="form-control" name="deskripsi_lapor"><?= $d_lapor_ubah['deskripsi_lapor']; ?></textarea><br>
                                                                <b>Link <i class="font-weight-bold">ERROR</i> : </b><br>
                                                                <textarea class="form-control" name="link_lapor"><?= $d_lapor_ubah['link_lapor']; ?></textarea><br>
                                                                <i>Screenshot ERROR : </i><br>
                                                                <input type="file" name="file_lapor" accept="image/png, image/gif, image/jpeg, image/jpg"><br><br>
                                                                <b>Level : </b><br>
                                                                <?php
                                                                $level1 = '';
                                                                $level2 = '';
                                                                $level3 = '';
                                                                if ($d_lapor_ubah['level_lapor'] == 'rendah') {
                                                                    $level1 = 'checked';
                                                                } elseif ($d_lapor_ubah['level_lapor'] == 'sedang') {
                                                                    $level2 = 'checked';
                                                                } elseif ($d_lapor_ubah['level_lapor'] == 'tinggi') {
                                                                    $level3 = 'checked';
                                                                }
                                                                ?>
                                                                <div class="custom-control custom-radio text-uppercase">
                                                                    <input type="radio" id="1<?= $d_lapor['id_lapor']; ?>" name="level_lapor" value="rendah" class="custom-control-input" required <?= $level1; ?>>
                                                                    <label class="custom-control-label" for="1<?= $d_lapor['id_lapor']; ?>">
                                                                        <span class="badge badge-success text-md">Rendah</span>
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio text-uppercase">
                                                                    <input type="radio" id="2<?= $d_lapor['id_lapor']; ?>" name="level_lapor" value="sedang" class="custom-control-input" <?= $level2; ?>>
                                                                    <label class="custom-control-label" for="2<?= $d_lapor['id_lapor']; ?>">
                                                                        <span class="badge badge-warning text-md">Sedang</span>
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio text-uppercase">
                                                                    <input type="radio" id="3<?= $d_lapor['id_lapor']; ?>" name="level_lapor" value="tinggi" class="custom-control-input" <?= $level3; ?>>
                                                                    <label class="custom-control-label" for="3<?= $d_lapor['id_lapor']; ?>">
                                                                        <span class="badge badge-danger text-md">Tinggi</span>
                                                                    </label>
                                                                </div><br>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input name="id_lapor" value="<?= $d_lapor_ubah['id_lapor']; ?>" hidden>
                                                                <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal">Kembali</button>
                                                                <button type="submit" class="btn btn-primary btn-sm" name="ubah_lapor">Ubah</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>



                                            <!-- tombol ubah lapor -->
                                            <a href="#" class="btn btn-danger btn-sm" title="Hapus Lapor" data-toggle="modal" data-target="#hapus_<?= $d_lapor['id_lapor']; ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>

                                            <!-- modal ubah lapor -->
                                            <div class="modal fade" id="hapus_<?= $d_lapor['id_lapor']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form class="form-group" method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Yakin Hapus Lapor ?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input name="id_lapor" value="<?= $d_lapor['id_lapor']; ?>" hidden>
                                                                <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal">Kembali</button>
                                                                <button type="submit" class="btn btn-danger btn-sm" name="hapus_lapor">hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                } else {
                ?>
                    <h3 class='text-center'> Data Laporan Tidak Ada</h3>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
?>