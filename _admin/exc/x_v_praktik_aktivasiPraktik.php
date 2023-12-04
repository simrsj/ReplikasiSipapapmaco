<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql_praktik = "SELECT * FROM tb_praktik WHERE id_praktik = " . $_GET['id'];
$q_praktik = $conn->query($sql_praktik);
$d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC);

if ($d_praktik['id_profesi_pdd'] == 1) {
    $sql = "UPDATE tb_praktik SET status_cek_praktik = 'AKV_PPDS', status_praktik = 'y' WHERE id_praktik = " . $_GET['id'];
} else {
    $sql = "UPDATE tb_praktik SET status_cek_praktik = 'AKV', status_praktik = 'y' WHERE id_praktik = " . $_GET['id'];
}

// echo $sql;
$conn->query($sql);
