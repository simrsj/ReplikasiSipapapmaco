<?php

define('JUMLAH_KOLOM2', 7);

function generateKalenderNklNnk($date)
{

    include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
    $day = date('d', $date);
    $month = date('m', $date);
    $year = date('Y', $date);

    $firstDay = mktime(0, 0, 0, $month, 1, $year);
    $title = strftime('%B', $firstDay);
    $dayOfWeek = date('D', $firstDay);
    $daysInMonth = cal_days_in_month(0, $month, $year);
    /* Get the name of the week days */
    $timestamp = strtotime('next Sunday');
    $weekDays = array();

    for ($i = 0; $i < JUMLAH_KOLOM2; $i++) {
        $weekDays[] = strftime('%a', $timestamp);
        $timestamp = strtotime('+1 day', $timestamp);
    }
    $blank = date('w', strtotime("{$year}-{$month}-01"));
?>

    <div class="table-responsive">
        <table class='table table-striped'>
            <thead class="thead-dark">
                <tr>
                    <th colspan="<?= JUMLAH_KOLOM2 ?>" class="text-center">
                        <?= $title . " " . $year; ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center">
                    <?php
                    foreach ($weekDays as $key => $weekDay) {
                    ?>
                        <td class="text-center"><?= $weekDay ?></td>
                    <?php
                    }
                    ?>
                </tr>
                <tr class="text-center">
                    <?php
                    for ($i = 0; $i < $blank; $i++) {
                    ?>
                        <td></td>
                    <?php
                    }
                    ?>
                    <?php
                    for ($i = 1; $i <= $daysInMonth; $i++) {
                        // echo strlen((string)$i) . "-" . $i;

                        //tambah 0 jika tanggal 1 digit
                        if (strlen((string)$i) == 1) {
                            $t = "0" . $i;
                        } else {
                            $t = $i;
                        }

                        $tgl = $year . "-" . $month . "-" . $t;

                        $sql_nklNnk = "SELECT * FROM tb_praktik";
                        $sql_nklNnk .= " JOIN tb_praktik_tgl  ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik";
                        $sql_nklNnk .= " WHERE tb_praktik_tgl.praktik_tgl = '$tgl'";
                        $sql_nklNnk .= " AND NOT tb_praktik.id_jurusan_pdd IN (1,2)";
                        $sql_nklNnk .= " AND status_praktik ='Y' ";
                        $sql_nklNnk .= " ";
                        // echo "$sql_kedKep<br>";
                        $q_nklNnk = $conn->query($sql_nklNnk);

                        $jp_jt = 0;
                        $jp_j = 0;
                        $id = 0;
                        $jp_j_far = 0;
                        $jp_j_kl = 0;
                        $jp_j_psi = 0;
                        $jp_j_rm = 0;
                        $jp_j_it = 0;
                        $jp_j_ps = 0;
                        $kuota_far = 0;
                        $kuota_kl = 0;
                        $kuota_psi = 0;
                        $kuota_rm = 0;
                        $kuota_it = 0;
                        $kuota_ps = 0;
                        while ($d_nklNnk = $q_nklNnk->fetch(PDO::FETCH_ASSOC)) {
                            if ($d_nklNnk['id_praktik'] != $id) {
                                // $jp_jt = $jp_j + $d_nklNnk['jumlah_praktik'];

                                //Kuota masing-masing dari kedokteran dan keperawatan
                                if ($d_nklNnk['id_jurusan_pdd'] == 5) {
                                    $kuota_far = $jp_j_far + $d_nklNnk['jumlah_praktik'];
                                } elseif ($d_nklNnk['id_jurusan_pdd'] == 7) {
                                    $kuota_kl = $jp_j_kl + $d_nklNnk['jumlah_praktik'];
                                } elseif ($d_nklNnk['id_jurusan_pdd'] == 3) {
                                    $kuota_psi = $jp_j_psi + $d_nklNnk['jumlah_praktik'];
                                } elseif ($d_nklNnk['id_jurusan_pdd'] == 8) {
                                    $kuota_rm = $jp_j_rm + $d_nklNnk['jumlah_praktik'];
                                } elseif ($d_nklNnk['id_jurusan_pdd'] == 4) {
                                    $kuota_it = $jp_j_it + $d_nklNnk['jumlah_praktik'];
                                } elseif ($d_nklNnk['id_jurusan_pdd'] == 6) {
                                    $kuota_ps = $jp_j_ps + $d_nklNnk['jumlah_praktik'];
                                }
                            } else {
                                // $jp_j = $d_kedKep['jumlah_praktik'];
                                $jp_j_far = $d_nklNnk['jumlah_praktik'];
                                $jp_j_kl = $d_nklNnk['jumlah_praktik'];
                                $jp_j_psi = $d_nklNnk['jumlah_praktik'];
                                $jp_j_rm = $d_nklNnk['jumlah_praktik'];
                                $jp_j_it = $d_nklNnk['jumlah_praktik'];
                                $jp_j_ps = $d_nklNnk['jumlah_praktik'];
                                $id = $d_nklNnk['id_praktik'];
                            }
                        }

                        //Kuota Harian Farmasi
                        $sql_kuotaFar = "SELECT * FROM tb_kuota";
                        $sql_kuotaFar .= " WHERE id_kuota= 2";
                        $q_kuotaFar = $conn->query($sql_kuotaFar);
                        $d_kuotaFar = $q_kuotaFar->fetch(PDO::FETCH_ASSOC);;
                        $totalKuotaFar = $d_kuotaFar['jumlah_kuota'];

                        //Kuota Harian Kesling
                        $sql_kuotaKl = "SELECT * FROM tb_kuota";
                        $sql_kuotaKl .= " WHERE id_kuota= 3";
                        $q_kuotaKl = $conn->query($sql_kuotaKl);
                        $d_kuotaKl = $q_kuotaKl->fetch(PDO::FETCH_ASSOC);
                        $totalKuotaKl = $d_kuotaKl['jumlah_kuota'];

                        //Kuota Harian Psikologi
                        $sql_kuotaPsi = "SELECT * FROM tb_kuota";
                        $sql_kuotaPsi .= " WHERE id_kuota= 4";
                        $q_kuotaPsi = $conn->query($sql_kuotaPsi);
                        $d_kuotaPsi = $q_kuotaPsi->fetch(PDO::FETCH_ASSOC);
                        $totalKuotaPsi = $d_kuotaPsi['jumlah_kuota'];

                        //Kuota Harian Rekam Medis
                        $sql_kuotaRm = "SELECT * FROM tb_kuota";
                        $sql_kuotaRm .= " WHERE id_kuota= 5";
                        $q_kuotaRm = $conn->query($sql_kuotaRm);
                        $d_kuotaRm = $q_kuotaRm->fetch(PDO::FETCH_ASSOC);
                        $totalKuotaRm = $d_kuotaRm['jumlah_kuota'];

                        //Kuota Harian Informasi Teknologi
                        $sql_kuotaIt = "SELECT * FROM tb_kuota";
                        $sql_kuotaIt .= " WHERE id_kuota= 6";
                        $q_kuotaIt = $conn->query($sql_kuotaIt);
                        $d_kuotaIt = $q_kuotaIt->fetch(PDO::FETCH_ASSOC);
                        $totalKuotaIt = $d_kuotaIt['jumlah_kuota'];

                        //Kuota Harian Peksos
                        $sql_kuotaPs = "SELECT * FROM tb_kuota";
                        $sql_kuotaPs .= " WHERE id_kuota= 7";
                        $q_kuotaPs = $conn->query($sql_kuotaPs);
                        $d_kuotaPs = $q_kuotaPs->fetch(PDO::FETCH_ASSOC);
                        $totalKuotaPs = $d_kuotaPs['jumlah_kuota'];

                        // echo $jp_jt . "-" . $kuota_ked . "-" . $kuota_kep . "<br>";
                        if ($day == $i) {
                    ?>
                            <td>
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item dropdown no-arrow mx-1">
                                        <button type="button" class="btn btn-outline-primary btn-sm form-control" data-toggle="dropdown" id="tlg2<?= $tgl; ?>" title="<?= tanggal($tgl); ?>">
                                            <?= $i; ?>
                                        </button>

                                        <!-- Dropdown - Alerts -->
                                        <div class="dropdown-list dropdown-menu dropdown-menu-right dropdown-menu-xl shadow" aria-labelledby="tgl2<?= $tgl; ?>">
                                            <h5 class="text-gray-800 text-center font-weight-bold">
                                                <?= tanggal($tgl); ?> </h5>
                                            <div class="dropdown-item d-flex align-items-center">
                                                <div>
                                                    <div class="text-gray-600 font-weight-bold">Farmasi</div>
                                                    <span class="badge badge-primary text-md">Terisi : <span class="badge badge-dark"><?= $kuota_far; ?></span> </span> &nbsp;
                                                    <span class="badge badge-primary text-md">Sisa : <span class="badge badge-light">
                                                            <?php
                                                            $kalFar = $totalKuotaFar - $kuota_far;
                                                            if ($kalFar <= 0) {
                                                                echo "Penuh";
                                                            } else {
                                                                echo $kalFar;
                                                            }
                                                            ?>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="dropdown-item d-flex align-items-center">
                                                <div>
                                                    <div class="text-gray-600 font-weight-bold">Kesehatang Lingkungan</div>
                                                    <span class="badge badge-primary text-md">Terisi : <span class="badge badge-dark"><?= $kuota_kl; ?></span> </span> &nbsp;
                                                    <span class="badge badge-primary text-md">Sisa : <span class="badge badge-light">
                                                            <?php
                                                            $kalKl = $totalKuotaKl - $kuota_kl;
                                                            if ($kalKl <= 0) {
                                                                echo "Penuh";
                                                            } else {
                                                                echo $kalKl;
                                                            }
                                                            ?>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="dropdown-item d-flex align-items-center">
                                                <div>
                                                    <div class="text-gray-600 font-weight-bold">Psikologi</div>
                                                    <span class="badge badge-primary text-md">Terisi : <span class="badge badge-dark"><?= $kuota_psi; ?></span> </span> &nbsp;
                                                    <span class="badge badge-primary text-md">Sisa : <span class="badge badge-light">
                                                            <?php
                                                            $kalPsi = $totalKuotaPsi - $kuota_psi;
                                                            if ($kalPsi <= 0) {
                                                                echo "Penuh";
                                                            } else {
                                                                echo $kalPsi;
                                                            }
                                                            ?>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="dropdown-item d-flex align-items-center">
                                                <div>
                                                    <div class="text-gray-600 font-weight-bold">Rekam Medis</div>
                                                    <span class="badge badge-primary text-md">Terisi : <span class="badge badge-dark"><?= $kuota_rm; ?></span> </span> &nbsp;
                                                    <span class="badge badge-primary text-md">Sisa : <span class="badge badge-light">
                                                            <?php
                                                            $kalRm = $totalKuotaRm - $kuota_rm;
                                                            if ($kalRm <= 0) {
                                                                echo "Penuh";
                                                            } else {
                                                                echo $kalRm;
                                                            }
                                                            ?>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="dropdown-item d-flex align-items-center">
                                                <div>
                                                    <div class="text-gray-600 font-weight-bold">Informasi Teknologi</div>
                                                    <span class="badge badge-primary text-md">Terisi : <span class="badge badge-dark"><?= $kuota_it; ?></span> </span> &nbsp;
                                                    <span class="badge badge-primary text-md">Sisa : <span class="badge badge-light">
                                                            <?php
                                                            $kalIt = $totalKuotaIt - $kuota_it;
                                                            if ($kalIt <= 0) {
                                                                echo "Penuh";
                                                            } else {
                                                                echo $kalIt;
                                                            }
                                                            ?>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="dropdown-item d-flex align-items-center">
                                                <div>
                                                    <div class="text-gray-600 font-weight-bold">Pekerja Sosial</div>
                                                    <span class="badge badge-primary text-md">Terisi : <span class="badge badge-dark"><?= $kuota_ps; ?></span> </span> &nbsp;
                                                    <span class="badge badge-primary text-md">Sisa : <span class="badge badge-light">
                                                            <?php
                                                            $kalPs = $totalKuotaPs - $kuota_ps;
                                                            if ($kalPs <= 0) {
                                                                echo "Penuh";
                                                            } else {
                                                                echo $kalPs;
                                                            }
                                                            ?>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        <?php
                        } else {
                        ?>
                            <td>
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item dropdown no-arrow mx-1">
                                        <button type="button" class="btn btn-outline-primary btn-sm form-control" data-toggle="dropdown" id="tlg2<?= $tgl; ?>" title="<?= tanggal($tgl); ?>">
                                            <?= $i; ?>
                                        </button>

                                        <!-- Dropdown - Alerts -->
                                        <div class="dropdown-list dropdown-menu dropdown-menu-right dropdown-menu-xl shadow" aria-labelledby="tgl2<?= $tgl; ?>">
                                            <h5 class="text-gray-800 text-center font-weight-bold">
                                                <?= tanggal($tgl); ?> </h5>
                                            <div class="dropdown-item d-flex align-items-center">
                                                <div>
                                                    <div class="text-gray-600 font-weight-bold">Farmasi</div>
                                                    <span class="badge badge-primary text-md">Terisi : <span class="badge badge-dark"><?= $kuota_far; ?></span> </span> &nbsp;
                                                    <span class="badge badge-primary text-md">Sisa : <span class="badge badge-light">
                                                            <?php
                                                            $kalFar = $totalKuotaFar - $kuota_far;
                                                            if ($kalFar <= 0) {
                                                                echo "Penuh";
                                                            } else {
                                                                echo $kalFar;
                                                            }
                                                            ?>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="dropdown-item d-flex align-items-center">
                                                <div>
                                                    <div class="text-gray-600 font-weight-bold">Kesehatang Lingkungan</div>
                                                    <span class="badge badge-primary text-md">Terisi : <span class="badge badge-dark"><?= $kuota_kl; ?></span> </span> &nbsp;
                                                    <span class="badge badge-primary text-md">Sisa : <span class="badge badge-light">
                                                            <?php
                                                            $kalKl = $totalKuotaKl - $kuota_kl;
                                                            if ($kalKl <= 0) {
                                                                echo "Penuh";
                                                            } else {
                                                                echo $kalKl;
                                                            }
                                                            ?>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="dropdown-item d-flex align-items-center">
                                                <div>
                                                    <div class="text-gray-600 font-weight-bold">Psikologi</div>
                                                    <span class="badge badge-primary text-md">Terisi : <span class="badge badge-dark"><?= $kuota_psi; ?></span> </span> &nbsp;
                                                    <span class="badge badge-primary text-md">Sisa : <span class="badge badge-light">
                                                            <?php
                                                            $kalPsi = $totalKuotaPsi - $kuota_psi;
                                                            if ($kalPsi <= 0) {
                                                                echo "Penuh";
                                                            } else {
                                                                echo $kalPsi;
                                                            }
                                                            ?>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="dropdown-item d-flex align-items-center">
                                                <div>
                                                    <div class="text-gray-600 font-weight-bold">Rekam Medis</div>
                                                    <span class="badge badge-primary text-md">Terisi : <span class="badge badge-dark"><?= $kuota_rm; ?></span> </span> &nbsp;
                                                    <span class="badge badge-primary text-md">Sisa : <span class="badge badge-light">
                                                            <?php
                                                            $kalRm = $totalKuotaRm - $kuota_rm;
                                                            if ($kalRm <= 0) {
                                                                echo "Penuh";
                                                            } else {
                                                                echo $kalRm;
                                                            }
                                                            ?>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="dropdown-item d-flex align-items-center">
                                                <div>
                                                    <div class="text-gray-600 font-weight-bold">Informasi Teknologi</div>
                                                    <span class="badge badge-primary text-md">Terisi : <span class="badge badge-dark"><?= $kuota_it; ?></span> </span> &nbsp;
                                                    <span class="badge badge-primary text-md">Sisa : <span class="badge badge-light">
                                                            <?php
                                                            $kalIt = $totalKuotaIt - $kuota_it;
                                                            if ($kalIt <= 0) {
                                                                echo "Penuh";
                                                            } else {
                                                                echo $kalIt;
                                                            }
                                                            ?>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="dropdown-item d-flex align-items-center">
                                                <div>
                                                    <div class="text-gray-600 font-weight-bold">Pekerja Sosial</div>
                                                    <span class="badge badge-primary text-md">Terisi : <span class="badge badge-dark"><?= $kuota_ps; ?></span> </span> &nbsp;
                                                    <span class="badge badge-primary text-md">Sisa : <span class="badge badge-light">
                                                            <?php
                                                            $kalPs = $totalKuotaPs - $kuota_ps;
                                                            if ($kalPs <= 0) {
                                                                echo "Penuh";
                                                            } else {
                                                                echo $kalPs;
                                                            }
                                                            ?>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        <?php
                        }
                        if (($i + $blank) % JUMLAH_KOLOM2 == 0) {
                        ?>
                </tr>
                <tr class="text-center">
            <?php
                        }
                    }
            ?>
            <br>
            <?php
            for ($i = 0; ($i + $blank + $daysInMonth) % JUMLAH_KOLOM2 != 0; $i++) {
            ?>
                <td></td>
            <?php
            }
            ?>
                </tr>
            </tbody>
        </table>
    </div>
<?php
}

// ===========================

/* Set the default timezone */
date_default_timezone_set("Asia/Hong_Kong");
$tahun_sekarang = date('Y');
$bulan_sekarang = date('m') - 1;
// $tahun_10 = date("Y", strtotime(date("Y", strtotime($StaringDate)) . " + 1 year"));
for ($iterateYear = $tahun_sekarang; $iterateYear <= $tahun_sekarang + 1; $iterateYear++) {
    for ($iterateMonth = 1; $iterateMonth <= 12; $iterateMonth++) {
        // TAHUN BERJALAN 
        if ($iterateYear == $tahun_sekarang) {
            if ($bulan_sekarang < $iterateMonth) {
                /* Set the date */
                $date = strtotime(sprintf('%s-%s-01', $iterateYear, $iterateMonth));
                generateKalenderNklNnk($date);
            }
        } else {

            /* Set the date */
            $date = strtotime(sprintf('%s-%s-01', $iterateYear, $iterateMonth));
            generateKalenderNklNnk($date);
        }
    }
}
