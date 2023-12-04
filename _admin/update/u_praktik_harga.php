<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <h1 class="h3 mb-2 text-gray-800">Ubah Data Harga</h1>
        </div>
    </div>
    <form action="" class="form-group" method="post">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Harga</th>
                                <th scope="col">Jumlah Harga</th>
                                <th scope="col">Frekuensi</th>
                                <th scope="col">Kuantitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id_praktik = $_GET['uh'];

                            $sql_harga_pilih = "SELECT * FROM tb_harga_pilih 
                                JOIN tb_harga ON tb_harga_pilih.id_harga = tb_harga.id_harga
                                JOIN tb_praktik ON tb_harga_pilih.id_praktik = tb_praktik.id_praktik
                                WHERE tb_praktik.id_praktik = $id_praktik
                                ORDER BY tb_harga.nama_harga ASC";

                            $q_harga_pilih = $conn->query($sql_harga_pilih);
                            $no = 1;
                            while ($d_harga_pilih = $q_harga_pilih->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $no; ?></th>
                                    <td><?= $d_harga_pilih['nama_harga']; ?></td>
                                    <td><?= "Rp " . number_format($d_harga_pilih['jumlah_harga'], 0, ",", "."); ?></td>
                                    <td>
                                        <input type="number" name="frek_<?= $d_harga_pilih['id_harga_pilih'] ?>" value="<?= $d_harga_pilih['frekuensi_harga_pilih']; ?>" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" name="kntt_<?= $d_harga_pilih['id_harga_pilih'] ?>" value="<?= $d_harga_pilih['kuantitas_harga_pilih']; ?>" class="form-control">
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Simpan -->
        <div class="card shadow mb-4 ">
            <div class="card-body">
                <input name="id_praktik" value="<?= $_GET['uh'] ?>" hidden>
                <button type="submit" class="form-control btn btn-success btn-sm" name='ubah_harga'>UBAH</button>
            </div>
        </div>
    </form>
</div>
<?php
if (isset($_POST['ubah_harga'])) {
    $id_praktik = $_POST['id_praktik'];
    $sql_harga_pilih = "SELECT * FROM tb_harga_pilih 
    JOIN tb_harga ON tb_harga_pilih.id_harga = tb_harga.id_harga
    JOIN tb_praktik ON tb_harga_pilih.id_praktik = tb_praktik.id_praktik
    WHERE tb_praktik.id_praktik = $id_praktik
    ORDER BY tb_harga.nama_harga ASC";
    // echo $sql_harga_pilih;
    $q_harga_pilih = $conn->query($sql_harga_pilih);
    while ($d_harga_pilih = $q_harga_pilih->fetch(PDO::FETCH_ASSOC)) {
        $sql_update_harga_pilih = " UPDATE `tb_harga_pilih` SET
        `tgl_ubah_harga_pilih` = '" . date('Y-m-d', time()) . "', 
        `frekuensi_harga_pilih` = '" . $_POST['frek_' . $d_harga_pilih['id_harga_pilih']] . "', 
        `kuantitas_harga_pilih` = '" . $_POST['kntt_' . $d_harga_pilih['id_harga_pilih']] . "', 
        `jumlah_harga_pilih` = '" . $_POST['frek_' . $d_harga_pilih['id_harga_pilih']] * $_POST['kntt_' . $d_harga_pilih['id_harga_pilih']] * $d_harga_pilih['jumlah_harga'] . "'
        WHERE tb_harga_pilih.id_praktik = " . $id_praktik . " AND tb_harga_pilih.id_harga_pilih = " . $d_harga_pilih['id_harga_pilih'];

        // echo $sql_update_harga_pilih . "<br>";
        $conn->query($sql_update_harga_pilih);
    }
?>
    <script type="text/javascript">
        document.location.href = "?ptk";
    </script>
<?php
}
?>