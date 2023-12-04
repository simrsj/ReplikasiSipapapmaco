<?php include "_admin/dashboard_admin_pkdData.php"; ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Laporan
        </a> -->
    </div>

    <div class="row justify-content-md-center">

        <!-- Data PKD -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-md font-weight-bold  text-success mb-1 b">
                                JUMLAH PENDAPATAN PKD YANG AKAN DATANG :
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= "Rp " . number_format($ds_pdpt_tmd, 0, '.', '.'); ?>
                                </div>
                            </div>
                            <div class="text-md font-weight-bold text-success mb-1 b">
                                JUMLAH PENDAPATAN PKD SELESAI :
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= "Rp " . number_format($ds_pdpt_ts, 0, '.', '.'); ?>
                                </div>
                            </div>
                            <div class="text-md font-weight-bold text-success mb-1 b">
                                JUMLAH TOTAL PENDAPATAN PKD :
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= "Rp " . number_format($ds_pdpt_t, 0, '.', '.'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendapatan PKD -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-md font-weight-bold  text-primary mb-1 b">
                                JUMLAH PKD YANG AKAN DATANG :
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <b><?= $ds_keg_tmd; ?></b> Kegiatan
                                </div>
                            </div>
                            <div class="text-md font-weight-bold text-primary mb-1 b">
                                JUMLAH PKD SELESAI :
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <b><?= $ds_keg_ts; ?></b> Kegiatan
                                </div>
                            </div>
                            <div class="text-md font-weight-bold text-primary mb-1 b">
                                JUMLAH TOTAL PKD :
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <b><?= $ds_keg_t; ?></b> Kegiatan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Data Tabel PKD -->
        <div class="col-xl-7 col-lg-6  mb-4">
            <div class="card shadow mb-4 h-100">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data PKD</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?php
                    $sql_pkd = "SELECT * FROM tb_pkd order by tgl_pel_pkd DESC";
                    try {
                        $q_pkd = $conn->query($sql_pkd);
                        $r_pkd = $q_pkd->rowCount();
                    } catch (Exception $ex) {
                        echo "<script>alert('-DATA PKD-');";
                        echo "document.location.href='?error404';</script>";
                    }
                    ?>
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <th scope='col'>No</th>
                                    <th>Nama Pemohon</th>
                                    <th>Rincian Kegiatan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($d_pkd = $q_pkd->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no; ?></td>
                                        <td><?= $d_pkd['nama_pemohon_pkd']; ?></td>
                                        <td><?= $d_pkd['rincian_pkd']; ?></td>
                                        <td class="text-center text-lg">
                                            <?php if ($d_pkd['tgl_pel_pkd'] > date('Y-m-d', time())) { ?>
                                                <span class="badge badge-success">Yang Akan Datang</span>
                                            <?php } else if ($d_pkd['tgl_pel_pkd'] < date('Y-m-d', time())) { ?>
                                                <span class="badge badge-primary">Selesai</span>
                                            <?php } else { ?>
                                                <span class="badge badge-warning text-dark">Sedang<br>Berlangsung</span>
                                            <?php } ?>
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
        </div>

        <!-- Data Presentase PKD -->
        <div class="col-xl-5 col-lg-6  mb-4">
            <div class="card shadow mb-4 shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Persentase PKD</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" height="100%">
                    <canvas id="grafikPemohon"></canvas>
                    <script>
                        var grafikPemohon = document.getElementById("grafikPemohon");

                        Chart.defaults.global.defaultFontFamily = "Lato";
                        Chart.defaults.global.defaultFontSize = 13;
                        Chart.defaults.global.legend.display = false;

                        var jumlahPermohonan = {
                            label: false,
                            data: [
                                <?php
                                foreach ($ds_jumlahPemohon_ar as $nomor_ar => $isi) {
                                    echo "'" . $isi . "',";
                                }
                                ?>
                            ],
                            backgroundColor: '#4e73df',
                            borderColor: 'rgba(0, 99, 132, 1)',
                            yAxisID: "y-axis-jumlahPemohon"
                        };
                        // var gravityData = {
                        //     label: false,
                        //     data: [3.7, 8.9, 9.8, 3.7, 23.1, 9.0, 8.7, 11.0],
                        //     backgroundColor: 'rgba(99, 132, 0, 0.6)',
                        //     borderColor: 'rgba(99, 132, 0, 1)',
                        //     yAxisID: "y-axis-gravity"
                        // };
                        var namaPemohon = {
                            labels: [
                                <?php
                                foreach ($ds_pemohon_ar as $nomor_ar => $isi) {
                                    echo "'" . $isi . "',";
                                }
                                ?>
                            ],
                            // datasets: [densityData, gravityData]
                            datasets: [jumlahPermohonan]
                        };
                        var chartOptions = {
                            scales: {
                                xAxes: [{
                                    barPercentage: 1,
                                    categoryPercentage: 0.6
                                }],
                                yAxes: [{
                                    id: "y-axis-jumlahPemohon",
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        };
                        var barChart = new Chart(grafikPemohon, {
                            type: 'bar',
                            data: namaPemohon,
                            options: chartOptions
                        });
                    </script>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->