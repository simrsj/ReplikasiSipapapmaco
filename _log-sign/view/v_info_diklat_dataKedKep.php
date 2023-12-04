<?php

define('JUMLAH_KOLOM1', 7);

function generateKalenderKedKep($date)
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

    for ($i = 0; $i < JUMLAH_KOLOM1; $i++) {
        $weekDays[] = strftime('%a', $timestamp);
        $timestamp = strtotime('+1 day', $timestamp);
    }
    $blank = date('w', strtotime("{$year}-{$month}-01"));
?>

    <div class="table-responsive pt-0">
        <table class='table table-striped'>
            <thead class="thead-dark">
                <tr>
                    <th colspan="<?= JUMLAH_KOLOM1 ?>" class="text-center">
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
                        $sql_kedKep = "SELECT * FROM tb_praktik";
                        $sql_kedKep .= " JOIN tb_praktik_tgl  ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik";
                        $sql_kedKep .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
                        $sql_kedKep .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
                        $sql_kedKep .= " WHERE tb_praktik_tgl.praktik_tgl = '$tgl'";
                        $sql_kedKep .= " AND (tb_praktik.id_jurusan_pdd = 1 OR tb_praktik.id_jurusan_pdd = 2)";
                        $sql_kedKep .= " AND (tb_praktik.status_praktik = 'Y')";
                        // echo "$sql_kedKep<br>";
                        $q_kedKep = $conn->query($sql_kedKep);
                        $q1_kedKep = $conn->query($sql_kedKep);

                        $jp_jt = 0;
                        $jp_j = 0;
                        $id = 0;
                        $jp_j_ked = 0;
                        $jp_j_kep = 0;
                        $kuota_ked = 0;
                        $kuota_kep = 0;
                        while ($d_kedKep = $q_kedKep->fetch(PDO::FETCH_ASSOC)) {
                            if ($d_kedKep['id_praktik'] != $id) {

                                //Kuota masing-masing dari kedokteran dan keperawatan
                                if ($d_kedKep['id_jurusan_pdd'] == 1) {
                                    $kuota_ked += $jp_j + $d_kedKep['jumlah_praktik'];
                                } elseif ($d_kedKep['id_jurusan_pdd'] == 2) {
                                    $kuota_kep += $jp_j + $d_kedKep['jumlah_praktik'];
                                }

                                $jp_jt = ($kuota_ked + $jp_j_ked) + ($kuota_kep + $jp_j_kep);
                            } else {
                                $jp_j = $d_kedKep['jumlah_praktik'];
                                $jp_j_ked = $kuota_ked;
                                $jp_j_kep = $kuota_kep;
                                $id = $d_kedKep['id_praktik'];
                            }
                        }

                        $sql_kuotaKedKep = "SELECT * FROM tb_kuota";
                        $sql_kuotaKedKep .= " WHERE id_kuota= 1";

                        $q_kuotaKedKep = $conn->query($sql_kuotaKedKep);
                        $d_kuotaKedKep = $q_kuotaKedKep->fetch(PDO::FETCH_ASSOC);
                        $kuota_kedKep = $d_kuotaKedKep['jumlah_kuota'];

                        //penentuan jenis tombol
                        if ($jp_jt == 0) {
                            $btn_kedKep = "success";
                        } elseif (($jp_jt > 0) && ($jp_jt < $kuota_kedKep)) {
                            $btn_kedKep = "warning";
                        } elseif ($jp_jt >= $kuota_kedKep) {
                            $btn_kedKep = "danger";
                        } else {
                            $btn_kedKep = "secondary";
                        }
                        // echo $jp_jt . "-" . $kuota_ked . "-" . $kuota_kep . "<br>";

                        if ($day == $i) {
                    ?>
                            <td>
                                <!-- tombol modal -->
                                <button type="button" class="btn btn-outline-<?= $btn_kedKep; ?> btn-sm form-control" data-toggle="modal" data-target="#tlg<?= $tgl; ?>" title="<?= tanggal($year . "-" . $month . "-" . $i); ?>"><?= $i; ?></button>

                                <!-- modal   -->
                                <div class="modal fade text-gray-800" id="tlg<?= $tgl; ?>" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="text-center text-lg">INFO PRAKTIK KEDOKTERAN DAN KEPERAWATAN TANGGAL <b><?= tanggal($tgl); ?></b></div>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row text-center">
                                                    <div class="col-md-6 my-auto">
                                                        KEDOKTERAN : <?= $kuota_ked; ?><br>
                                                        KEPERAWATAN : <?= $kuota_kep; ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        KUOTA PRAKTIKAN : <?= $kuota_kedKep; ?><br>
                                                        JUMLAH TOTAL PRAKTIKAN : <?= $jp_jt; ?><br>
                                                        JUMLAH SISA PRAKTIKAN : <?= $kuota_kedKep - $jp_jt; ?><br>
                                                    </div>
                                                </div>
                                                <hr>
                                                <?php
                                                if ($q1_kedKep->rowCount() > 0) {
                                                ?>
                                                    <div class="table-responsive text-left">
                                                        <table class='table table-striped'>
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th>Nama Institusi</th>
                                                                    <th>Jurusan</th>
                                                                    <th>Jumlah Praktik</th>
                                                                    <th>Tanggal Mulai</th>
                                                                    <th>Tanggal Selesai</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                while ($d1_kedKep = $q1_kedKep->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $d1_kedKep['nama_institusi']; ?></td>
                                                                        <td><?= $d1_kedKep['nama_jurusan_pdd']; ?></td>
                                                                        <td><?= $d1_kedKep['jumlah_praktik']; ?></td>
                                                                        <td><?= tanggal($d1_kedKep['tgl_mulai_praktik']); ?></td>
                                                                        <td><?= tanggal($d1_kedKep['tgl_selesai_praktik']); ?></td>
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
                                                    <div class="jumbotron">
                                                        <div class="jumbotron-fluid font-weight-bold text-center">
                                                            DATA PRAKTIK TIDAK ADA
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        <?php
                        } else {
                        ?>
                            <td>
                                <!-- tombol modal -->
                                <button type="button" class="btn btn-outline-<?= $btn_kedKep; ?> btn-sm form-control" data-toggle="modal" data-target="#tlg<?= $tgl; ?>" title="<?= tanggal($year . "-" . $month . "-" . $i); ?>"><?= $i; ?></button>

                                <!-- modal   -->
                                <div class="modal fade text-gray-800" id="tlg<?= $tgl; ?>" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="text-center text-lg">INFO PRAKTIK KEDOKTERAN DAN KEPERAWATAN TANGGAL <b><?= tanggal($tgl); ?></b></div>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row text-center">
                                                    <div class="col-md-6 my-auto">
                                                        KEDOKTERAN : <?= $kuota_ked; ?><br>
                                                        KEPERAWATAN : <?= $kuota_kep; ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        KUOTA PRAKTIKAN : <?= $kuota_kedKep; ?><br>
                                                        JUMLAH TOTAL PRAKTIKAN : <?= $jp_jt; ?><br>
                                                        JUMLAH SISA PRAKTIKAN : <?= $kuota_kedKep - $jp_jt; ?><br>
                                                    </div>
                                                </div>
                                                <hr>
                                                <?php
                                                if ($q1_kedKep->rowCount() > 0) {
                                                ?>
                                                    <div class="table-responsive text-left">
                                                        <table class='table table-striped'>
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th>Nama Institusi</th>
                                                                    <th>Jurusan</th>
                                                                    <th>Jumlah Praktik</th>
                                                                    <th>Tanggal Mulai</th>
                                                                    <th>Tanggal Selesai</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                while ($d1_kedKep = $q1_kedKep->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $d1_kedKep['nama_institusi']; ?></td>
                                                                        <td><?= $d1_kedKep['nama_jurusan_pdd']; ?></td>
                                                                        <td><?= $d1_kedKep['jumlah_praktik']; ?></td>
                                                                        <td><?= tanggal($d1_kedKep['tgl_mulai_praktik']); ?></td>
                                                                        <td><?= tanggal($d1_kedKep['tgl_selesai_praktik']); ?></td>
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
                                                    <div class="jumbotron">
                                                        <div class="jumbotron-fluid font-weight-bold">
                                                            DATA PRAKTIK TIDAK ADA
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        <?php
                        }
                        if (($i + $blank) % JUMLAH_KOLOM1 == 0) {
                        ?>
                </tr>
                <tr class="text-center">
            <?php
                        }
                    }
            ?>
            <br>
            <?php
            for ($i = 0; ($i + $blank + $daysInMonth) % JUMLAH_KOLOM1 != 0; $i++) {
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
date_default_timezone_set("Asia/Jakarta");
$tahun_sekarang = date('Y');
$bulan_sekarang = date('m') - 1;
// $tahun_10 = date("Y", strtotime(date("Y", strtotime($StaringDate)) . " + 1 year"));
for ($iterateYear = $tahun_sekarang; $iterateYear <= ($tahun_sekarang + 1); $iterateYear++) {
    for ($iterateMonth = 1; $iterateMonth <= 12; $iterateMonth++) {
        // TAHUN BERJALAN 
        if ($iterateYear == $tahun_sekarang) {
            if ($bulan_sekarang < $iterateMonth) {
                /* Set the date */
                $date = strtotime(sprintf('%s-%s-01', $iterateYear, $iterateMonth));
                generateKalenderKedKep($date);
            }
        } else {
            /* Set the date */
            $date = strtotime(sprintf('%s-%s-01', $iterateYear, $iterateMonth));
            generateKalenderKedKep($date);
        }
    }
}
