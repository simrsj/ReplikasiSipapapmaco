<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10">
            <h1 class="h3 mb-2 text-gray-800">Daftar Profesi</h1>
        </div>
        <div class="col-lg-2">
            <a class='btn btn-outline-success btn-sm' href='#' data-toggle='modal' data-target='#pfs_i_m'>
                <i class="fas fa-plus"></i> Tambah
            </a>
            <!-- modal tambah profesi  -->
            <div class="modal fade" id="pfs_i_m">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="">
                            <div class="modal-header">
                                Tambah Profesi
                            </div>
                            <div class="modal-body">
                                <input class="form-control" name="nama_profesi_pdd">
                                <br>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-sm" name="tambah">Tambah</button>
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
                $sql_profesi_pdd = "SELECT * FROM tb_profesi_pdd order by nama_profesi_pdd ASC";
                $q_profesi_pdd = $conn->query($sql_profesi_pdd);
                $r_profesi_pdd = $q_profesi_pdd->rowCount();
                if ($r_profesi_pdd > 0) {
                ?>
                    <table class='table table-striped' id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope='col'>No</th>
                                <th>Nama Profesi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($d_profesi_pdd = $q_profesi_pdd->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $d_profesi_pdd['nama_profesi_pdd']; ?></td>
                                    <td>
                                        <a title="Ubah" class='btn btn-primary btn-sm' href='#' data-toggle='modal' data-target='<?= "#pfs_u_m" . $d_profesi_pdd['id_profesi_pdd']; ?>'>
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a title="Hapus" class='btn btn-danger btn-sm' href='#' data-toggle='modal' data-target='<?= "#pfs_d_m" . $d_profesi_pdd['id_profesi_pdd']; ?>'>
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                    <?php $no++; ?>
                                    <!-- modal ubah profesi  -->
                                    <div class="modal fade" id="<?= "pfs_u_m" . $d_profesi_pdd['id_profesi_pdd']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="post" action="">
                                                    <div class="modal-header">
                                                        Ubah Profesi
                                                    </div>
                                                    <div class="modal-body">
                                                        <input name="id_profesi_pdd" value="<?= $d_profesi_pdd['id_profesi_pdd']; ?>" hidden>
                                                        <input class="form-control" name="nama_profesi_pdd" value="<?= $d_profesi_pdd['nama_profesi_pdd']; ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success" name="ubah">Ubah</button>
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="<?= "pfs_d_m" . $d_profesi_pdd['id_profesi_pdd']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="post" action="">
                                                    <div class="modal-header">
                                                        <h5>Hapus Data</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6><b><?= $d_profesi_pdd['nama_profesi_pdd']; ?></b></h6>
                                                        <input name="id_profesi_pdd" value="<?= $d_profesi_pdd['id_profesi_pdd']; ?>" hidden>
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
            <h3 class="text-center text-justify"> Data Profesi Tidak Ada</h3>
        <?php
                }
        ?>
        </div>
    </div>
</div>
<?php
if (isset($_POST['ubah'])) {
    $conn->query("UPDATE `tb_profesi_pdd` SET `nama_profesi_pdd` = '" . $_POST['nama_profesi_pdd'] . "' WHERE `tb_profesi_pdd`.`id_profesi_pdd` = " . $_POST['id_profesi_pdd']);
?>
    <script>
        document.location.href = "?pfs";
    </script>
<?php
} elseif (isset($_POST['tambah'])) {
    $conn->query("INSERT INTO `tb_profesi_pdd` (`nama_profesi_pdd`) VALUES ('" . $_POST['nama_profesi_pdd'] . "')");
?>
    <script>
        document.location.href = "?pfs";
    </script>
<?php
} elseif (isset($_POST['hapus'])) {
    $conn->query("DELETE FROM `tb_profesi_pdd` WHERE `id_profesi_pdd` = " . $_POST['id_profesi_pdd']);
?>
    <script>
        document.location.href = "?pfs";
    </script>
<?php
}
?>