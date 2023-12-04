<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
try {
    $sql = "UPDATE tb_logbook_ked_coass_kyd SET ";
    $sql .= " tgl_ubah = '" . date('Y-m-d G:i:s') . "',";
    $sql .= " ruang = '" . $_POST['ruang'] . "',";
    $sql .= " tgl = '" . $_POST['tgl'] . "',";
    $sql .= " nama_pasien = '" . $_POST['nama_pasien'] . "',";
    $sql .= " usia = '" . $_POST['usia'] . "',";
    $sql .= " jenis_kelamin = '" . $_POST['jenis_kelamin'] . "',";
    $sql .= " medrec = '" . $_POST['medrec'] . "',";
    $sql .= " diagnosis = '" . $_POST['diagnosis'] . "',";
    $sql .= " terapi = '" . $_POST['terapi'] . "'";
    $sql .= " WHERE id = " . decryptString($_POST['id'], $customkey);
    $conn->query($sql);
    echo json_encode([
        // 'sql' => $sql,
        'ket' => 'SUCCESS'
    ]);
} catch (PDOException $ex) {
    echo json_encode([
        // 'sql' => $sql,
        'ket' => 'ERROR'
    ]);
}
