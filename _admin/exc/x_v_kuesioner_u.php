<?php
error_reporting(0);
require_once $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

try {
    if ($_POST['pertanyaan'] != "") {
        $sql = "UPDATE tb_kuesioner_pertanyaan SET";
        $sql .= " tgl_ubah = '" . date('Y-m-d G:i:s') . "',";
        $sql .= " pertanyaan = '" . $_POST['pertanyaan'] . "',";
        $sql .= " ket = '" . $_POST['ket'] . "'";
        $sql .= " WHERE id = " . decryptString($_POST['id'], $customkey);
        $conn->query($sql);
        $ket = "success";
    } else $ket = "Data Tidak Sesuai";
    echo json_encode([
        // 'sql' => $sql,
        'ket' => $ket
    ]);
} catch (Exception $ex) {
    echo json_encode([
        // 'sql' => $sql,
        'ket' => 'error'
    ]);
}
