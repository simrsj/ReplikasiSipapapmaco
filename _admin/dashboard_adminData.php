<?php
//////////////////// DATA KERJASAMA TOTAL ////////////////////
$sql_dmt = "SELECT * FROM tb_kerjasama ";
$q_dmt = $conn->query($sql_dmt);
$dashboard_dmt = $q_dmt->rowCount();

//////////////////// DATA KERJASAMA AKTIF //////////////////////
$sql_dma = "SELECT * FROM tb_kerjasama ";
$sql_dma .= " WHERE tgl_selesai_mou >= CURDATE() AND arsip IS NULL";
$q_dma = $conn->query($sql_dma);
$dashboard_dma = $q_dma->rowCount();

//////////////////// DATA KERJASAMA BERAKHIR ////////////////////
$sql_dmb = "SELECT * FROM tb_kerjasama ";
$sql_dmb .= " WHERE tgl_selesai_mou < CURDATE() AND arsip IS NULL";
$q_dmb = $conn->query($sql_dmb);
$dashboard_dmb = $q_dmb->rowCount();
/*--------------------------------------------------------------*/

//////////////////// DATA PRAKTIK PROSES ////////////////////
$sql_dpp = "SELECT * FROM tb_praktik";
$sql_dpp .= " WHERE tgl_mulai_praktik > CURDATE()";
$q_dpp = $conn->query($sql_dpp);
$dashboard_dpp = $q_dpp->rowCount();

//////////////////// DATA PRAKTIK AKTIF ////////////////////
$sql_dpa = "SELECT * FROM tb_praktik";
$sql_dpa .= " WHERE CURDATE() BETWEEN tgl_mulai_praktik AND tgl_selesai_praktik";
$q_dpa = $conn->query($sql_dpa);
$dashboard_dpa = $q_dpa->rowCount();

//////////////////// DATA PRAKTIK SELESAI ////////////////////
$sql_dps = "SELECT * FROM tb_praktik";
$sql_dps .= " WHERE tgl_selesai_praktik < CURDATE()";
// echo $sql_dps;
$q_dps = $conn->query($sql_dps);
$dashboard_dps = $q_dps->rowCount();

/*--------------------------------------------------------------*/

//////////////////// DATA PRAKTIKAN JUMLAH PROSES ////////////////////
$sql_dprtknp = "SELECT SUM(jumlah_praktik) AS JP FROM tb_praktik";
$sql_dprtknp .= " WHERE tgl_mulai_praktik > CURDATE()";
$q_dprtknp = $conn->query($sql_dprtknp);
$d_dprtknp = $q_dprtknp->fetch(PDO::FETCH_ASSOC);
$dashboard_dprtknp = $d_dprtknp['JP'];
if ($dashboard_dprtknp == NULL)
    $dashboard_dprtknp = 0;

//////////////////// DATA PRAKTIKAN JUMLAH AKTIF /////////////////////
$sql_dprtkna = "SELECT SUM(JUMLAH_PRAKTIK) AS JP FROM tb_praktik";
$sql_dprtkna .= " WHERE CURDATE() BETWEEN tgl_mulai_praktik AND tgl_selesai_praktik";
$dashboard_dprtkna = 0;
$q_dprtkna = $conn->query($sql_dprtkna);
$d_dprtkna = $q_dprtkna->fetch(PDO::FETCH_ASSOC);
$dashboard_dprtkna = $d_dprtkna['JP'];
if ($dashboard_dprtkna == NULL)
    $dashboard_dprtkna = 0;


//////////////////// DATA PRAKTIKAN JUMLAH SELESAI ////////////////////
$sql_dprtkns = "SELECT SUM(JUMLAH_PRAKTIK) AS JP FROM tb_praktik";
$sql_dprtkns .= " WHERE tgl_selesai_praktik < CURDATE()";
// echo $sql_dps;
$q_dprtkns = $conn->query($sql_dprtkns);
$d_dprtkns = $q_dprtkns->fetch(PDO::FETCH_ASSOC);
$dashboard_dprtkns = $d_dprtkns['JP'];
if ($dashboard_dprtkns == NULL)
    $dashboard_dprtkns = 0;

/*--------------------------------------------------------------*/

//////////////////// PENDAPATAN////////////////////

$total_tarif = 0;
$total_tarif_pilih = 0;
$total_mess = 0;
$sql_praktik = "SELECT * FROM tb_tarif_pilih";
$sql_praktik .= " JOIN tb_praktik ON tb_tarif_pilih.id_praktik = tb_praktik.id_praktik";
$sql_praktik .= " JOIN tb_bayar ON tb_bayar.id_praktik = tb_praktik.id_praktik";
$sql_praktik .= " WHERE tb_bayar.status_bayar =  'TERIMA'";
$q_praktik = $conn->query($sql_praktik);

#semua
while ($d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC)) {
    $total_tarif = $total_tarif + $d_praktik['jumlah_tarif_pilih'];
    $total_tarif_pilih = $total_tarif_pilih + $d_praktik['jumlah_tarif_pilih'];
}
