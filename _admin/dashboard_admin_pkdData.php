<?php
//////////////////// PENDAPATAN ////////////////////
$sql_pdpt_t = "SELECT SUM(total_pkd_tarif) AS total FROM tb_pkd_tarif ";
$q_pdpt_t = $conn->query($sql_pdpt_t);
$d_pdpt_t = $q_pdpt_t->fetch(PDO::FETCH_ASSOC);
$ds_pdpt_t = $d_pdpt_t['total'];
//////////////////// PENDAPATAN SELESAI////////////////////
$sql_pdpt_ts = "SELECT SUM(total_pkd_tarif) AS total FROM tb_pkd_tarif ";
$sql_pdpt_ts .= "JOIN tb_pkd ON tb_pkd_tarif.id_pkd = tb_pkd.id_pkd ";
$sql_pdpt_ts .= "WHERE tgl_pel_pkd <= '" . date('Y-m-d', time()) . "'";
$q_pdpt_ts = $conn->query($sql_pdpt_ts);
$d_pdpt_ts = $q_pdpt_ts->fetch(PDO::FETCH_ASSOC);
$ds_pdpt_ts = $d_pdpt_ts['total'];
//////////////////// PENDAPATAN YG AKAN DATANG////////////////////
$sql_pdpt_tmd = "SELECT SUM(total_pkd_tarif) AS total FROM tb_pkd_tarif ";
$sql_pdpt_tmd .= "JOIN tb_pkd ON tb_pkd_tarif.id_pkd = tb_pkd.id_pkd ";
$sql_pdpt_tmd .= "WHERE tgl_pel_pkd > '" . date('Y-m-d', time()) . "'";
$q_pdpt_tmd = $conn->query($sql_pdpt_tmd);
$d_pdpt_tmd = $q_pdpt_tmd->fetch(PDO::FETCH_ASSOC);
$ds_pdpt_tmd = $d_pdpt_tmd['total'];
//////////////////// KEGIATAN TOTAL ////////////////////
$sql_keg_t = "SELECT *  FROM tb_pkd";
$q_keg_t = $conn->query($sql_keg_t);
$ds_keg_t = $q_keg_t->rowCount();
//////////////////// PENDAPATAN SELESAI////////////////////
$sql_keg_ts = "SELECT *  FROM tb_pkd WHERE tgl_pel_pkd <= '" . date('Y-m-d', time()) . "'";
$q_keg_ts = $conn->query($sql_keg_ts);
$ds_keg_ts = $q_keg_ts->rowCount();
//////////////////// PENDAPATAN YG AKAN DATANG////////////////////
$sql_keg_tmd = "SELECT *  FROM tb_pkd WHERE tgl_pel_pkd > '" . date('Y-m-d', time()) . "'";
$q_keg_tmd = $conn->query($sql_keg_tmd);
$ds_keg_tmd = $q_keg_tmd->rowCount();

//////////////////// DATA PEMOHON ARRAY ////////////////////
$sql_pemohon = "SELECT *  FROM tb_pkd GROUP BY nama_pemohon_pkd";
$q_pemohon = $conn->query($sql_pemohon);
$no = 0;
while ($d_pemohon =  $q_pemohon->fetch(PDO::FETCH_ASSOC)) {
    $ds_pemohon_ar[$no] = $d_pemohon['nama_pemohon_pkd'];

    $sql_jumlahPemohon = "SELECT COUNT(nama_pemohon_pkd) as jumlahpemohon FROM tb_pkd WHERE nama_pemohon_pkd= '" . $d_pemohon['nama_pemohon_pkd'] . "'";
    $q_jumlahPemohon = $conn->query($sql_jumlahPemohon);
    $d_jumlahPemohon =  $q_jumlahPemohon->fetch(PDO::FETCH_ASSOC);
    $ds_jumlahPemohon_ar[$no] = $d_jumlahPemohon['jumlahpemohon'];

    $no++;
}
