<?php
if (isset($_GET['pars']) && $d_prvl['status_aktivasi_user'] == "Y") {
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="h3 mb-2 text-gray-800">Daftar Arsip Praktikan</h1>
            </div>
            <!-- <div class="col-lg-2 text-right">
            <a href="?dpk&a" class="btn btn-outline-info btn-sm">
                <i>
                    <i class="fas fa-archive"></i>
                </i>Arsip
            </a>
        </div> -->
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-body " style="font-size: medium;">
                    <!-- data praktikan -->
                    <?php
                    $sql_data_praktikan = "SELECT * FROM tb_praktikan ";
                    $sql_data_praktikan .= " JOIN tb_praktik ON tb_praktikan.id_praktik = tb_praktik.id_praktik";
                    $sql_data_praktikan .= " WHERE tb_praktik.id_praktik = " . $_GET['dp'];
                    $sql_data_praktikan .= " ORDER BY tb_praktikan.nama_praktikan ASC";

                    $q_data_praktikan = $conn->query($sql_data_praktikan);
                    $r_data_praktikan = $q_data_praktikan->rowCount();

                    if ($r_data_praktikan > 0) {
                    ?>
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">NIM / NPM / NIS </th>
                                        <th scope="col">No. HP</th>
                                        <th scope="col">No. WA</th>
                                        <th scope="col">EMAIL</th>
                                        <th scope="col">ASAL KOTA / KABUPATEN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_jumlah_tarif = 0;
                                    $no = 1;
                                    while ($d_data_praktikan = $q_data_praktikan->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $no; ?></th>
                                            <td><?= $d_data_praktikan['nama_praktikan']; ?></td>
                                            <td><?= $d_data_praktikan['no_id_praktikan']; ?></td>
                                            <td><?= $d_data_praktikan['telp_praktikan']; ?></td>
                                            <td><?= $d_data_praktikan['wa_praktikan']; ?></td>
                                            <td><?= $d_data_praktikan['email_praktikan']; ?></td>
                                            <td><?= $d_data_praktikan['kota_kab_praktikan']; ?></td>
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
                        <div class="jumbotron">
                            <div class="jumbotron-fluid">
                                <div class="text-gray-700">
                                    <h5 class="text-center">Data Praktikan Tidak Ada</h5>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <hr>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    echo "<script>alert('unauthorized-data arsip praktik');document.location.href='?error401';</script>";
}
