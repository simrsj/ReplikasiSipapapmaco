<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
$i = 0;
try {
    $sql = "UPDATE tb_logbook_ked_residen_jkh SET ";
    $sql .= " tgl_ubah = '" . date('Y-m-d G:i:s') . "',";
    $sql .= " tgl = '" . $_POST['tgl'] . "',";
    $sql .= " visite_besar = '" . $_POST['visite_besar'] . "',";
    $sql .= " rapat_klinik = '" . $_POST['rapat_klinik'] . "',";
    $sql .= " acara_ilmiah = '" . $_POST['acara_ilmiah'] . "',";
    $sql .= " matkul_dosen = '" . $_POST['matkul_dosen'] . "',";
    $sql .= " j_pasien_rajal = '" . $_POST['j_pasien_rajal'] . "',";
    $sql .= " j_pasien_rajal = '" . $_POST['j_pasien_rajal'] . "'";
    $sql .= " WHERE id = " . decryptString($_POST['id'], $customkey);
    $conn->query($sql);
    echo json_encode([
        // 'sql' => $sql,
        // 'cok' => $i,
        'ket' => 'SUCCESS'
    ]);
    $i++;
} catch (PDOException $ex) {
    echo json_encode([
        // 'sql' => $sql,
        // 'cek' => 'cek',        
        'ket' => $ex->getMessage() . $ex->getLine()

    ]);
}
