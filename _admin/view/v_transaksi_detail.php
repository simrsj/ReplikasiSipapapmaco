<?php
$sql_data_praktik = "SELECT * FROM tb_praktik ";
$sql_data_praktik .= " JOIN tb_institusi ON tb_institusi.id_institusi = tb_praktik.id_institusi ";
$sql_data_praktik .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
$sql_data_praktik .= " JOIN tb_jenjang_pdd ON tb_praktik.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd";
$sql_data_praktik .= " JOIN tb_profesi_pdd ON tb_praktik.id_profesi_pdd = tb_profesi_pdd.id_profesi_pdd";
$sql_data_praktik .= " AND tb_institusi.id_institusi = " . $_SESSION['id_institusi'];
$sql_data_praktik .= " WHERE tb_praktik.id_praktik ='" . $_GET['dtl'] . "'";

$q_data_praktik = $conn->query($sql_data_praktik);
$d_data_praktik = $q_data_praktik->fetch(PDO::FETCH_ASSOC);


$id_praktik = $_GET['dtl'];

#data tarif pilih
$sql_data_tarif = "SELECT * FROM tb_tarif_pilih";
$sql_data_tarif .= " JOIN tb_praktik ON tb_tarif_pilih.id_praktik = tb_praktik.id_praktik";
$sql_data_tarif .= " WHERE tb_praktik.id_praktik = '$id_praktik'";
$sql_data_tarif .= " ORDER BY tb_tarif_pilih.nama_tarif_pilih ASC";
$q_data_tarif = $conn->query($sql_data_tarif);

$data_tarif = array();
$no = 1;
$total_tarif = 0;
while ($d_data_tarif = $q_data_tarif->fetch(PDO::FETCH_ASSOC)) {
    array_push(
        $data_tarif,
        array(
            $no,
            $d_data_tarif['nama_tarif_pilih'],
            $d_data_tarif['nama_satuan_tarif_pilih'],
            "Rp " . number_format($d_data_tarif['nominal_tarif_pilih'], 0, ",", "."),
            $d_data_tarif['frekuensi_tarif_pilih'],
            $d_data_tarif['kuantitas_tarif_pilih'],
            "Rp " . number_format($d_data_tarif['jumlah_tarif_pilih'], 0, ",", ".")
        )
    );
    $total_tarif = $total_tarif + $d_data_tarif['jumlah_tarif_pilih'];
    $no++;
}

// // echo "<pre>";
// print_r($data_tarif);
// // echo "</pre>";

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-11">
            <h1 class="h3 mb-2 text-gray-800">Daftar Transaksi</h1>
        </div>
        <!-- <div class="col-md-1">
            <a class="btn btn-outline-dark btn-sm" href="?trs">
                <i class="fas fa-arrow-circle-left"></i>
                Kembali
            </a>
        </div> -->
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-3 my-auto">
                    <b>Nama Institusi :</b><br>
                    <?= $d_data_praktik['nama_institusi']; ?><br><br>
                    <b>Kelompok / Gelombang Praktik :</b><br>
                    <?= $d_data_praktik['nama_praktik']; ?><br><br>
                </div>
                <div class="col-md-3">
                    <b>Jurusan :</b><br>
                    <?= $d_data_praktik['nama_jurusan_pdd']; ?><br><br>
                    <b>Jenjang :</b><br>
                    <?= $d_data_praktik['nama_jenjang_pdd']; ?><br><br>
                    <b>Profesi :</b><br>
                    <?php
                    if ($d_data_praktik['id_profesi_pdd'] == 0) {
                        echo "-";
                    } else {
                        echo $d_data_praktik['nama_profesi_pdd'];
                    }
                    ?>
                </div>
                <div class="col-md-3">
                    <b>Tanggal Mulai :</b><br>
                    <?= tanggal($d_data_praktik['tgl_mulai_praktik']); ?><br><br>
                    <b>Tanggal Selesai :</b><br>
                    <?= tanggal($d_data_praktik['tgl_selesai_praktik']); ?><br><br>
                    <b>Total Tarif :</b><br>
                    <?= "Rp " . number_format($total_tarif, 0, '.', '.'); ?>
                </div>
                <div class="col-md-3  my-auto">
                    <div class="jumbotron ">
                        <div class="jumbotron-fluid ">
                            <b>Unduh Berkas INVOICE :</b><br><br>
                            <a href="<?= $d_praktik['surat_praktik']; ?> " target="_blank" class="btn btn-success btn-sm">
                                <i class="fas fa-file-download"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Tarif</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Jumlah Tarif</th>
                            <th scope="col">Frek.</th>
                            <th scope="col">Ktt.</th>
                            <th scope="col">Total Tarif</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($data_tarif as $baris) {
                            echo "<tr>";
                            foreach ($baris as $b) {
                                echo "<td>" . $b . "</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>