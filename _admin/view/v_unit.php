<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10">
            <h1 class="h3 mb-2 text-gray-800">Daftar Unit</h1>
        </div>
        <div class="col-lg-2">
            <a class='btn btn-outline-success btn-sm' href='#' data-toggle='modal' data-target='#uni_i_m'>
                <i class="fas fa-plus"></i> Tambah
            </a>
            <!-- modal tambah Unit  -->
            <div class="modal fade" id="uni_i_m">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="">
                            <div class="modal-header">
                                Tambah Unit :
                            </div>
                            <div class="modal-body">
                                <input class="form-control" name="nama_unit">
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
                $sql_unit = "SELECT * FROM tb_unit order by nama_unit ASC";
                $q_unit = $conn->query($sql_unit);
                $r_unit = $q_unit->rowCount();
                if ($r_unit > 0) {
                ?>
                    <table class='table table-striped' id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope='col'>No</th>
                                <th>Nama Unit</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($d_unit = $q_unit->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $d_unit['nama_unit']; ?></td>
                                    <td>
                                        <a title="Ubah" class='btn btn-primary btn-sm' href='#' data-toggle='modal' data-target='<?= "#uni_u_m" . $d_unit['id_unit']; ?>'>
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a title="Hapus" class='btn btn-danger btn-sm' href='#' data-toggle='modal' data-target='<?= "#uni_d_m" . $d_unit['id_unit']; ?>'>
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                    <?php $no++; ?>
                                    <!-- modal ubah Unit  -->
                                    <div class="modal fade" id="<?= "uni_u_m" . $d_unit['id_unit']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="post" action="">
                                                    <div class="modal-header">
                                                        Ubah Unit
                                                    </div>
                                                    <div class="modal-body">
                                                        <input name="id_unit" value="<?= $d_unit['id_unit']; ?>" hidden>
                                                        <input class="form-control" name="nama_unit" value="<?= $d_unit['nama_unit']; ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success btn-sm" name="ubah">Ubah</button>
                                                        <button class="btn btn-outline-dark btn-sm" type="button" data-dismiss="modal">Kembali</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="<?= "uni_d_m" . $d_unit['id_unit']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="post" action="">
                                                    <div class="modal-header">
                                                        <h5>Hapus Data</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6><b><?= $d_unit['nama_unit']; ?></b></h6>
                                                        <input name="id_unit" value="<?= $d_unit['id_unit']; ?>" hidden>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger" name="hapus">Ya</button>
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
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
            <h3 class="text-center text-justify"> Data Unit Tidak Ada</h3>
        <?php
                }
        ?>
        </div>
    </div>
</div>
<?php
if (isset($_POST['ubah'])) {
    $conn->query("UPDATE `tb_unit` SET `nama_unit` = '" . $_POST['nama_unit'] . "' WHERE `tb_unit`.`id_unit` = " . $_POST['id_unit']);
?>
    <script>
        document.location.href = "?uni";
    </script>
<?php
} elseif (isset($_POST['tambah'])) {
    $conn->query("INSERT INTO `tb_unit` (`nama_unit`) VALUES ('" . $_POST['nama_unit'] . "')");
?>
    <script>
        document.location.href = "?uni";
    </script>
<?php
} elseif (isset($_POST['hapus'])) {
    $conn->query("DELETE FROM `tb_unit` WHERE `id_unit` = " . $_POST['id_unit']);
?>
    <script>
        document.location.href = "?uni";
    </script>
<?php
}
?>
<script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="vendor/datatables/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>