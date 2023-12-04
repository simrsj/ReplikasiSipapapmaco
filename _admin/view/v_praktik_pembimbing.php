<?php if (isset($_GET['pmbb']) && $d_prvl['r_praktik_pembimbing'] == "Y") { ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="h3 mb-2 text-gray-800">Daftar Pembimbing dan Ruangan</h1>
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
                <?php if ($d_praktik['status_alasan'] == "T") { ?>
                    <div class="badge badge-danger text-lg text-center">Alasan Mess Ditolak</div>
                <?php } elseif ($d_praktik['status_mess_praktik'] == "T" && $d_praktik['status_alasan'] == "") { ?>
                    <div class="badge badge-secondary text-lg text-center">Alasan Mess Belum DiPilih Admin</div>
                <?php } else { ?>
                    <?php
                    $sql_praktik = "SELECT * FROM tb_praktik ";
                    $sql_praktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi ";
                    $sql_praktik .= " JOIN tb_profesi_pdd ON tb_praktik.id_profesi_pdd = tb_profesi_pdd.id_profesi_pdd ";
                    $sql_praktik .= " JOIN tb_jenjang_pdd ON tb_praktik.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd ";
                    $sql_praktik .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd ";
                    $sql_praktik .= " JOIN tb_jurusan_pdd_jenis ON tb_jurusan_pdd.id_jurusan_pdd_jenis = tb_jurusan_pdd_jenis.id_jurusan_pdd_jenis ";
                    $sql_praktik .= " JOIN tb_praktikan ON tb_praktik.id_praktik = tb_praktikan.id_praktik ";
                    $sql_praktik .= " WHERE tb_praktik.status_praktik = 'Y' ";
                    if ($d_prvl['level_user'] == 2) {
                        $sql_praktik .= " AND tb_praktik.id_institusi = " . $d_prvl['id_institusi'];
                    }
                    $sql_praktik .= " GROUP BY tb_praktikan.id_praktik ";
                    $sql_praktik .= " ORDER BY tb_praktik.id_praktik DESC";
                    // echo "$sql_praktik<br>";
                    try {
                        $q_praktik = $conn->query($sql_praktik);
                    } catch (Exception $ex) {
                        echo "<script>alert('$ex -DATA PRAKTIK');";
                        echo "document.location.href='?error404';</script>";
                    }
                    $r_praktik = $q_praktik->rowCount();

                    if ($r_praktik > 0) {
                    ?>
                        <?php
                        while ($d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC)) {

                            $sql_praktik_pembimbing = "SELECT * FROM tb_pembimbing_pilih ";
                            $sql_praktik_pembimbing .= " JOIN tb_pembimbing ON tb_pembimbing_pilih.id_pembimbing = tb_pembimbing.id_pembimbing ";
                            $sql_praktik_pembimbing .= " JOIN tb_praktikan ON tb_pembimbing_pilih.id_praktikan = tb_praktikan.id_praktikan ";
                            $sql_praktik_pembimbing .= " JOIN tb_unit ON tb_pembimbing_pilih.id_unit = tb_unit.id_unit ";
                            $sql_praktik_pembimbing .= " JOIN tb_praktik ON tb_pembimbing_pilih.id_praktik = tb_praktik.id_praktik ";
                            $sql_praktik_pembimbing .= " WHERE tb_praktik.status_praktik = 'Y'";
                            $sql_praktik_pembimbing .= " AND tb_praktik.id_praktik = " . $d_praktik['id_praktik'];
                            $sql_praktik_pembimbing .= " ORDER BY tb_praktikan.nama_praktikan ASC";
                            // echo "$sql_praktik_pembimbing<br>";
                            try {
                                $q_praktik_pembimbing = $conn->query($sql_praktik_pembimbing);
                            } catch (Exception $ex) {
                                echo "<script>alert('$ex -DATA PRAKTIK');";
                                echo "document.location.href='?error404';</script>";
                            }
                            $r_praktik_pembimbing = $q_praktik_pembimbing->rowCount();
                        ?>
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header align-items-center bg-gray-200">
                                        <div class="row" style="font-size: small;" class="justify-content-center">
                                            <br><br>
                                            <div class="col-sm-4 text-center">
                                                <?php if ($_SESSION['level_user'] == 1) { ?>
                                                    <b class="text-gray-800">INSTITUSI : </b><br><?= $d_praktik['nama_institusi']; ?><br>
                                                <?php } ?>
                                                <b class="text-gray-800">GELOMBANG/KELOMPOK : </b><br><?= $d_praktik['nama_praktik']; ?>
                                            </div>

                                            <div class="col-sm-2 text-center">
                                                <b class="text-gray-800">TANGGAL MULAI : </b><br><?= tanggal($d_praktik['tgl_mulai_praktik']); ?><br>
                                                <b class="text-gray-800">TANGGAL SELESAI : </b><br><?= tanggal($d_praktik['tgl_selesai_praktik']); ?>
                                            </div>
                                            <div class="col-sm-2 text-center">
                                                <b class="text-gray-800">JURUSAN : </b><br><?= $d_praktik['nama_jurusan_pdd']; ?><br>
                                                <b class="text-gray-800">JENJANG : </b><br><?= $d_praktik['nama_jenjang_pdd']; ?>
                                            </div>
                                            <div class="col-sm-2 text-center">
                                                <b class="text-gray-800">PROFESI : </b><br><?= $d_praktik['nama_profesi_pdd']; ?><br>
                                                <b class="text-gray-800">JUMLAH PRAKTIKAN : </b><br><?= $d_praktik['jumlah_praktik']; ?>
                                            </div>
                                            <!-- tombol aksi/info proses  -->
                                            <div class="col-sm-2 my-auto text-right">
                                                <!-- tombol rincian -->
                                                <a class="btn btn-info btn-sm collapsed m-0 " data-toggle="collapse" data-target="#rincian<?= md5($d_praktik['id_praktik']); ?>" title="Rincian">
                                                    <i class="fas fa-info-circle"></i> Rincian
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- collapse data pembimbing -->
                                    <div id="rincian<?= md5($d_praktik['id_praktik']); ?>" class="collapse" aria-labelledby="heading<?= md5($d_praktik['id_praktik']); ?>" data-parent="#accordion">
                                        <div class="card-body " style="font-size: medium;">
                                            <!-- data praktikan -->
                                            <div class="row text-gray-700">
                                                <div class="col">
                                                    <h4 class="font-weight-bold">DATA PEMBIMBING DAN RUANGAN</h4><br>
                                                </div>
                                                <?php if ($d_prvl['c_praktik_pembimbing'] == 'Y') { ?>
                                                    <div class="col text-right">
                                                        <!-- tombol modal tambah permbimbing  -->
                                                        <a title="tambah/ubah permbimbing" class='btn btn-outline-info btn-sm' href='?pmbb=<?= urlencode(base64_encode($d_praktik['id_praktik'])); ?>&i'>
                                                            Tambah/Ubah Pembimbing
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <?php
                                            if ($r_praktik_pembimbing > 0) {
                                            ?>
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="dataTable">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">No</th>
                                                                <th scope="col">Nama Pembimbing</th>
                                                                <th scope="col">Ruangan </th>
                                                                <th scope="col">Nama Praktikan </th>
                                                                <th scope="col">NIM / NPM / NIS</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $total_jumlah_tarif = 0;
                                                            $no = 1;
                                                            while ($d_praktik_pembimbing = $q_praktik_pembimbing->fetch(PDO::FETCH_ASSOC)) {
                                                            ?>
                                                                <tr>
                                                                    <th scope="row"><?= $no; ?></th>
                                                                    <td><?= $d_praktik_pembimbing['nama_pembimbing']; ?></td>
                                                                    <td><?= $d_praktik_pembimbing['nama_unit']; ?></td>
                                                                    <td><?= $d_praktik_pembimbing['nama_praktikan']; ?></td>
                                                                    <td><?= $d_praktik_pembimbing['no_id_praktikan']; ?></td>
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
                                                            <h5 class="text-center">Data Pembimbing dan Ruangan Tidak Ada</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(function() {
                                    // check if there is a hash in the url
                                    if (window.location.hash != '') {
                                        // remove any accordion panels that are showing (they have a class of 'in')
                                        $('.collapse').removeClass('in');

                                        // show the panel based on the hash now:
                                        $(window.location.hash + '.collapse').collapse('show');
                                    }
                                });
                            </script>
                            <hr class="bg-gray-800">
                        <?php
                        }
                    } else {
                        ?>
                        <h3 class='text-center'> Isikan Data Praktikan Terlebih Dahulu</h3>
                    <?php
                    }
                    ?>

                <?php } ?>
            </div>
        </div>
    </div>
<?php } else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}
