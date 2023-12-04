<?php
// echo $_GET['id'] . "<br>";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
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
    <div class="table-responsive">
        <table class='table table-striped'>
            <thead class=" thead-dark">
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
                        $sql_messTgl = "SELECT * FROM tb_praktik";
                        $sql_messTgl .= " JOIN tb_praktik_tgl ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik";
                        $sql_messTgl .= " JOIN tb_mess_pilih ON tb_praktik.id_praktik = tb_mess_pilih.id_praktik";
                        $sql_messTgl .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
                        $sql_messTgl .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
                        $sql_messTgl .= " JOIN tb_mess ON tb_mess_pilih.id_mess = tb_mess.id_mess";
                        $sql_messTgl .= " WHERE tb_praktik_tgl.praktik_tgl = '$tgl' AND tb_mess.id_mess = " . $_GET['id'];
                        // echo "$sql_messTgl<br>";
                        try {
                            $q_mess = $conn->query($sql_messTgl);
                            $q1_mess = $conn->query($sql_messTgl);
                        } catch (Exception $ex) {

                            echo "<script>alert('Maaf Data Tidak Ada');document.location.href='?error404';</script>";
                        }

                        $jp_jt = 0;
                        while ($d_mess = $q_mess->fetch(PDO::FETCH_ASSOC)) {
                            $jp_jt += $d_mess['jumlah_praktik'];
                        }

                        $sql_kuotaMess = "SELECT * FROM tb_mess";
                        $sql_kuotaMess .= " WHERE id_mess= " .  $_GET['id'];
                        try {
                            $q_kuotaMess = $conn->query($sql_kuotaMess);
                        } catch (Exception $ex) {

                            echo "<script>alert('Maaf Data Tidak Ada');document.location.href='?error404';</script>";
                        }

                        $d_kuotaMess = $q_kuotaMess->fetch(PDO::FETCH_ASSOC);
                        $kuota_messTotal = $d_kuotaMess['kapasitas_t_mess'];

                        //penentuan jenis tombol
                        if ($jp_jt == 0) {
                            $btn_mess = "success";
                        } elseif (($jp_jt > 0) && ($jp_jt < $kuota_messTotal)) {
                            $btn_mess = "warning";
                        } elseif ($jp_jt >= $kuota_messTotal) {
                            $btn_mess = "danger";
                        } else {
                            $btn_mess = "secondary";
                        }

                        $sql_infoMess = " SELECT * FROM tb_mess ";
                        $sql_infoMess .= " WHERE tb_mess.id_mess = " . $_GET['id'];
                        // echo $sql_infoMess . "<br>";
                        try {
                            $q_infoMess = $conn->query($sql_infoMess);
                        } catch (Exception $ex) {

                            echo "<script>alert('Maaf Data Tidak Ada');document.location.href='?error404';</script>";
                        }

                        $d_infoMess = $q_infoMess->fetch(PDO::FETCH_ASSOC);
                        $kuota_sisa = $kuota_messTotal - $jp_jt;
                        if ($day == $i) {
                    ?>
                            <td>
                                <!-- tombol modal -->
                                <button type="button" class="btn btn-outline-<?= $btn_mess; ?> btn-sm form-control" data-toggle="modal" data-target="#tlg<?= $_GET['id'] . $tgl; ?>" title="<?= tanggal($year . "-" . $month . "-" . $i); ?>"><?= $i; ?></button>

                                <!-- modal   -->
                                <div class="modal fade text-gray-800" id="tlg<?= $_GET['id'] . $tgl; ?>">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="text-center text-lg text-uppercase">INFO MESS <?= $d_infoMess['nama_mess']; ?>, TANGGAL <b><?= tanggal($tgl); ?></b></div>
                                            </div>
                                            <div class="modal-body">
                                                JUMLAH PRAKTIK : <?= $jp_jt; ?><br>
                                                KUOTA MESS : <?= $kuota_messTotal; ?><br>
                                                KUOTA SISA : <?= $kuota_sisa; ?>
                                                <hr>
                                                <?php
                                                if ($q1_mess->rowCount() > 0) {
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
                                                                while ($d1_mess = $q1_mess->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $d1_mess['nama_institusi']; ?></td>
                                                                        <td><?= $d1_mess['nama_jurusan_pdd']; ?></td>
                                                                        <td><?= $d1_mess['jumlah_praktik']; ?></td>
                                                                        <td><?= tanggal($d1_mess['tgl_mulai_praktik']); ?></td>
                                                                        <td><?= tanggal($d1_mess['tgl_selesai_praktik']); ?></td>
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
                        } else {
                        ?>
                            <td>
                                <!-- tombol modal -->
                                <button type="button" class="btn btn-outline-<?= $btn_mess; ?> btn-sm form-control" data-toggle="modal" data-target="#tlg<?= $_GET['id'] . $tgl; ?>" title="<?= tanggal($year . "-" . $month . "-" . $i); ?>"><?= $i; ?></button>

                                <!-- modal   -->
                                <div class="modal fade text-gray-800" id="tlg<?= $_GET['id'] . $tgl; ?>">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="text-center text-lg text-uppercase">INFO MESS <?= $d_infoMess['nama_mess']; ?>, TANGGAL <b><?= tanggal($tgl); ?></b></div>
                                            </div>
                                            <div class="modal-body">
                                                JUMLAH PRAKTIK : <?= $jp_jt; ?><br>
                                                KUOTA MESS : <?= $kuota_messTotal; ?><br>
                                                KUOTA SISA : <?= $kuota_sisa; ?>
                                                <hr>
                                                <?php
                                                if ($q1_mess->rowCount() > 0) {
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
                                                                while ($d1_mess = $q1_mess->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $d1_mess['nama_institusi']; ?></td>
                                                                        <td><?= $d1_mess['nama_jurusan_pdd']; ?></td>
                                                                        <td><?= $d1_mess['jumlah_praktik']; ?></td>
                                                                        <td><?= tanggal($d1_mess['tgl_mulai_praktik']); ?></td>
                                                                        <td><?= tanggal($d1_mess['tgl_selesai_praktik']); ?></td>
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
