<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10">
            <h1 class="h3 mb-2 text-gray-800">Daftar Transaksi</h1>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php
            $sql_transaksi = "SELECT * FROM tb_praktik";
            $sql_transaksi .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
            $sql_transaksi .= " WHERE tb_praktik.status_praktik IN ('Y','S','A')";
            $sql_transaksi .= " AND tb_institusi.id_institusi = " . $_SESSION['id_institusi'];
            $sql_transaksi .= " ORDER BY tb_institusi.nama_institusi ASC";

            $q_transaksi = $conn->query($sql_transaksi);
            $r_transaksi = $q_transaksi->rowCount();

            if ($r_transaksi > 0) {
            ?>
                <table class='table table-striped' id="dataTable">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th scope='col'>No</th>
                            <th>Nama Institusi</th>
                            <th>Nama Praktik</th>
                            <th>Tanggal Mulai Praktik</th>
                            <th>Tanggal Selesa Praktik</th>
                            <th>Jumlah Praktik</th>
                            <th>Total Tarif Praktik</th>
                            <th>Status Praktik</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($d_transaksi = $q_transaksi->fetch(PDO::FETCH_ASSOC)) {

                            $total_tarif = 0;

                            //data tarif tb_tarif_pilih
                            $sql_data_tarif = "SELECT * FROM tb_praktik";
                            $sql_data_tarif .= " JOIN tb_tarif_pilih ON tb_praktik.id_praktik = tb_tarif_pilih.id_praktik";
                            $sql_data_tarif .= " WHERE tb_praktik.id_praktik = '" . $d_transaksi['id_praktik'] . "' ";
                            $sql_data_tarif .= " AND (tb_praktik.status_praktik = 'Y' OR tb_praktik.status_praktik = 'A')";

                            $q_data_tarif = $conn->query($sql_data_tarif);

                            while ($d_data_tarif = $q_data_tarif->fetch(PDO::FETCH_ASSOC)) {
                                $total_tarif = $total_tarif + $d_data_tarif['jumlah_tarif_pilih'];
                            }

                        ?>
                            <tr class="text-center">
                                <td><?= $no; ?></td>
                                <td><?= $d_transaksi['nama_institusi']; ?></td>
                                <td><?= $d_transaksi['nama_praktik']; ?></td>
                                <td><?= tanggal($d_transaksi['tgl_mulai_praktik']); ?></td>
                                <td><?= tanggal($d_transaksi['tgl_selesai_praktik']); ?></td>
                                <td><?= $d_transaksi['jumlah_praktik']; ?></td>
                                <td><?= "Rp " . number_format($total_tarif, 0, '.', ','); ?></td>
                                <td class="text-lg">
                                    <?php
                                    if ($d_transaksi['status_praktik'] == 'Y') {
                                    ?>
                                        <span class="badge badge-primary">SELESAI</span>
                                    <?php
                                    } elseif ($d_transaksi['status_praktik'] == 'A') {
                                    ?>
                                        <span class="badge badge-primary">ARSIP</span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="badge badge-danger">ERROR</span>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <!-- <a title="Cetak Invoice" target="_blank" class="btn btn-warning btn-sm" href="./_print/p_praktik_invoicePDF.php?id=<?= $d_praktik['id_praktik']; ?>">
                                        <i class="fas fa-print"></i>
                                    </a> -->

                                    <a title="Detail Tarif" class='btn btn-info btn-sm' href='<?= "?trs&dtl=" . $d_transaksi['id_praktik']; ?>'>
                                        <i class="fas fa-info-circle"></i> Rincian
                                    </a>
                                </td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
            ?>
                <h3 class='text-center'> Data Pembayaran Anda Tidak Ada</h3>
            <?php
            }
            ?>
        </div>
    </div>
</div>