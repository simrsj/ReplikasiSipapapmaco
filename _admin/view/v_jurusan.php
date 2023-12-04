<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10">
            <h1 class="h3 mb-2 text-gray-800">Daftar Jurusan</h1>
        </div>
        <div class="col-lg-2">
            <a class='btn btn-outline-success btn-sm' href='#' data-toggle='modal' data-target='#jrs_i_m'>
                <i class="fas fa-plus"></i> Tambah
            </a>
            <!-- modal tambah jurusan  -->
            <div class="modal fade" id="jrs_i_m">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="">
                            <div class="modal-header">
                                Tambah Jurusan :
                            </div>
                            <div class="modal-body">
                                <h6>Nama Jurusan : <span style="color: red;">*</span></h6>
                                <input class="form-control" name="nama_jurusan_pdd" required>
                                <br>
                                <h6>Jenis : <span style="color: red;">*</span></h6>
                                <select class="form-control" name="id_jurusan_pdd_jenis" required>
                                    <option value="">-- Pilih --</option>
                                    <?php
                                    $sql_jurusan_pdd_jenis = "SELECT * FROM tb_jurusan_pdd_jenis ORDER BY nama_jurusan_pdd_jenis ASC";
                                    $q_jurusan_pdd_jenis = $conn->query($sql_jurusan_pdd_jenis);
                                    while ($d_jurusan_pdd_jenis = $q_jurusan_pdd_jenis->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <option value="<?= $d_jurusan_pdd_jenis['id_jurusan_pdd_jenis'] ?>">
                                            <?= $d_jurusan_pdd_jenis['nama_jurusan_pdd_jenis']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-success btn-sm" name="tambah" value="Tambah ">
                                <button class="btn btn-outline-dark btn-sm" type="button" data-dismiss="modal">Kembali</button>
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
                $sql_jurusan_pdd = "SELECT * FROM tb_jurusan_pdd 
                JOIN tb_jurusan_pdd_jenis ON tb_jurusan_pdd.id_jurusan_pdd_jenis = tb_jurusan_pdd_jenis.id_jurusan_pdd_jenis 
                ORDER BY nama_jurusan_pdd ASC";

                $q_jurusan_pdd = $conn->query($sql_jurusan_pdd);
                $r_jurusan_pdd = $q_jurusan_pdd->rowCount();
                if ($r_jurusan_pdd > 0) {
                ?>
                    <table class='table table-striped' id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope='col'>No</th>
                                <th>Nama Jurusan</th>
                                <th>Jenis Jurusan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($d_jurusan_pdd = $q_jurusan_pdd->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $d_jurusan_pdd['nama_jurusan_pdd']; ?></td>
                                    <td><?= $d_jurusan_pdd['nama_jurusan_pdd_jenis']; ?></td>
                                    <td>
                                        <a title="Ubah" class='btn btn-primary btn-sm' href='#' data-toggle='modal' data-target='<?= "#jrs_u_m" . $d_jurusan_pdd['id_jurusan_pdd']; ?>'>
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a title="Hapus" class='btn btn-danger btn-sm' href='#' data-toggle='modal' data-target='<?= "#jrs_d_m" . $d_jurusan_pdd['id_jurusan_pdd']; ?>'>
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                    <?php $no++; ?>
                                    <!-- modal ubah jurusan  -->
                                    <div class="modal fade" id="<?= "jrs_u_m" . $d_jurusan_pdd['id_jurusan_pdd']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="post" class="form-group" action="">
                                                    <div class="modal-header">
                                                        Ubah Jurusan :
                                                    </div>
                                                    <div class="modal-body">
                                                        <input name="id_jurusan_pdd" value="<?= $d_jurusan_pdd['id_jurusan_pdd']; ?>" hidden>
                                                        <h6>Nama Jurusan :</h6>
                                                        <input class="form-control" name="nama_jurusan_pdd" value="<?= $d_jurusan_pdd['nama_jurusan_pdd']; ?>">
                                                        <br>
                                                        <h6>Jenis Jurusan :</h6>
                                                        <select class="form-control" name="id_jurusan_pdd_jenis" required>
                                                            <option value="">-- Pilih --</option>
                                                            <?php
                                                            $sql_jurusan_pdd_jenis = "SELECT * FROM tb_jurusan_pdd_jenis ORDER BY nama_jurusan_pdd_jenis ASC";
                                                            $q_jurusan_pdd_jenis = $conn->query($sql_jurusan_pdd_jenis);
                                                            while ($d_jurusan_pdd_jenis = $q_jurusan_pdd_jenis->fetch(PDO::FETCH_ASSOC)) {
                                                                if ($d_jurusan_pdd['id_jurusan_pdd_jenis'] == $d_jurusan_pdd_jenis['id_jurusan_pdd_jenis']) {
                                                                    $selected = "selected";
                                                                } else {
                                                                    $selected = "";
                                                                }
                                                            ?>
                                                                <option value="<?= $d_jurusan_pdd_jenis['id_jurusan_pdd_jenis'] ?>" <?= $selected ?>><?= $d_jurusan_pdd_jenis['nama_jurusan_pdd_jenis']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success btn-sm" name="ubah">Ubah</button>
                                                        <button class="btn btn-outline-dark btn-sm" type="button" data-dismiss="modal">Kembali</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="<?= "jrs_d_m" . $d_jurusan_pdd['id_jurusan_pdd']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="post" action="">
                                                    <div class="modal-header">
                                                        <h5>Hapus Data</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6><b><?= $d_jurusan_pdd['nama_jurusan_pdd']; ?></b></h6>
                                                        <input name="id_jurusan_pdd" value="<?= $d_jurusan_pdd['id_jurusan_pdd']; ?>" hidden>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger btn-sm" name="hapus">Ya</button>
                                                        <button class="btn btn-outline-dark btn-sm" type="button" data-dismiss="modal">Tidak</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
            </div>
        <?php
                } else {
        ?>
            <h3 class="text-center text-justify"> Data Jurusan Tidak Ada</h3>
        <?php
                }
        ?>
        </div>
    </div>
</div>
<?php
if (isset($_POST['ubah'])) {
    $conn->query("UPDATE `tb_jurusan_pdd` SET 
    `nama_jurusan_pdd` = '" . $_POST['nama_jurusan_pdd'] . "',
    `id_jurusan_pdd_jenis` = '" . $_POST['id_jurusan_pdd_jenis'] . "'
    WHERE `tb_jurusan_pdd`.`id_jurusan_pdd` = " . $_POST['id_jurusan_pdd']);
?>
    <script>
        document.location.href = "?jrs";
    </script>
<?php
} elseif (isset($_POST['tambah'])) {
    echo "Asdasd";
    $sql_tambah = "INSERT INTO `tb_jurusan_pdd` (
        `nama_jurusan_pdd`, 
        id_jurusan_pdd_jenis
        ) VALUES (
            '" . $_POST['nama_jurusan_pdd'] . "',
            '" . $_POST['id_jurusan_pdd_jenis'] . "'
            )";

    // echo $sql_tambah;
    $conn->query($sql_tambah);
?>
    <script>
        document.location.href = "?jrs";
    </script>
<?php
} elseif (isset($_POST['hapus'])) {
    $conn->query("DELETE FROM `tb_jurusan_pdd` WHERE `id_jurusan_pdd` = " . $_POST['id_jurusan_pdd']);
?>
    <script>
        document.location.href = "?jrs";
    </script>
<?php
}
?>