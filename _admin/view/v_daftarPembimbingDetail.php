<?php
if (isset($_GET['d_pmbb']) && $d_prvl['r_daftar_pembimbing'] == "Y") {
    $sql_pembimbing = "SELECT * FROM tb_pembimbing";
    $sql_pembimbing .= " JOIN tb_pembimbing_jenis ON tb_pembimbing.id_pembimbing_jenis = tb_pembimbing_jenis.id_pembimbing_jenis ";
    $sql_pembimbing .= " JOIN tb_jenjang_pdd ON tb_pembimbing.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd";
    $sql_pembimbing .= " WHERE id_pembimbing = " . base64_decode(urldecode(hex2bin($_GET['d_pmbb'])));

    try {
        $q_pembimbing = $conn->query($sql_pembimbing);
        $d_pembimbing = $q_pembimbing->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA PKD-');";
        echo "document.location.href='?error404';</script>";
    }
?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card shadow mb-4 mt-3">
            <div class="card-body">
                <div class="row text-center h6 text-gray-900 ">
                    <div class="col-md-6">
                        NIP/NIPK :
                        <b><?= $d_pembimbing['no_id_pembimbing']; ?></b>
                        <hr>
                        Nama Pembimbing :
                        <b><?= $d_pembimbing['nama_pembimbing']; ?></b>
                    </div>
                    <div class="col-md-6">
                        Jenis Pembimbing :
                        <b>
                            <?=
                            $d_pembimbing['nama_pembimbing_jenis'] . " (" . $d_pembimbing['akronim_pembimbing_jenis'] . ")";
                            ?>
                        </b>
                        <hr>
                        Jenjang Pendidikan :
                        <b><?= $d_pembimbing['nama_jenjang_pdd']; ?></b>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4 mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <?php
                    $sql_pembimbing_pilih = "SELECT * FROM tb_pembimbing_pilih";
                    $sql_pembimbing_pilih .= " JOIN tb_praktik ON tb_pembimbing_pilih.id_praktik = tb_praktik.id_praktik ";
                    $sql_pembimbing_pilih .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi ";
                    $sql_pembimbing_pilih .= " JOIN tb_profesi_pdd ON tb_praktik.id_profesi_pdd = tb_profesi_pdd.id_profesi_pdd ";
                    $sql_pembimbing_pilih .= " JOIN tb_jenjang_pdd ON tb_praktik.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd ";
                    $sql_pembimbing_pilih .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd ";
                    $sql_pembimbing_pilih .= " JOIN tb_jurusan_pdd_jenis ON tb_jurusan_pdd.id_jurusan_pdd_jenis = tb_jurusan_pdd_jenis.id_jurusan_pdd_jenis ";
                    $sql_pembimbing_pilih .= " GROUP BY tb_praktik.id_praktik";
                    // echo $sql_pembimbing_pilih;
                    try {
                        $q_pembimbing_pilih = $conn->query($sql_pembimbing_pilih);
                        $r_pembimbing_pilih = $q_pembimbing_pilih->rowCount();
                    } catch (Exception $ex) {
                        echo "<script>alert('$ex -DATA PKD-');";
                        echo "document.location.href='?error404';</script>";
                    }

                    if ($r_pembimbing_pilih > 0) {
                    ?>
                        <div class="table-responsive text-xs">
                            <table class="table table-striped" id="dataTable">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th scope='col'>No</th>
                                        <th>Nama Institsusi</th>
                                        <th>Kelompok</th>
                                        <th>Tanggal<br>Mulai</th>
                                        <th>Tanggal<br>Selesai</th>
                                        <th>Jurusan</th>
                                        <th>Jenjang</th>
                                        <th>Profesi</th>
                                    </tr>
                                </thead>
                                <tbody class="my-auto">
                                    <?php
                                    $no = 1;
                                    while ($d_pembimbing_pilih = $q_pembimbing_pilih->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $d_pembimbing_pilih['no_id_pembimbing']; ?></td>
                                            <td><?= $d_pembimbing_pilih['nama_institusi']; ?></td>
                                            <td><?= $d_pembimbing_pilih['nama_praktik']; ?></td>
                                            <td><?= tanggal($d_pembimbing['tgl_mulai_praktik']); ?></td>
                                            <td><?= tanggal($d_pembimbing['tgl_selesai_praktik']); ?></td>
                                            <td><?= $d_pembimbing_pilih['nama_jurusan_pdd']; ?></td>
                                            <td><?= $d_pembimbing_pilih['nama_jenjang_pdd']; ?></td>
                                            <td><?= $d_pembimbing_pilih['nama_profesi_pdd']; ?></td>
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
                            <div class="jumbotron-fluid font-weight-bold text-center">
                                <h3> Data Pembimbing Tidak Ada</h3>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php } else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}
