<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
try {
    $sql = "UPDATE tb_logbook_ked_residen_pkd SET ";
    $sql .= " tgl_ubah = '" . date('Y-m-d G:i:s') . "',";
    $sql .= " jenis = '" . $_POST['jenis'] . "',";
    $sql .= " tgl = '" . $_POST['tgl'] . "',";
    $sql .= " semester = '" . $_POST['semester'] . "',";
    $sql .= " no_rm = '" . $_POST['no_rm'] . "',";
    $sql .= " inisial = '" . $_POST['inisial'] . "',";
    $sql .= " icd10_diagnosis = '" . $_POST['icd10_diagnosis'] . "',";
    $sql .= " ket = '" . $_POST['ket'] . "'";
    $sql .= " WHERE id = " . decryptString($_POST['id'], $customkey);
    $conn->query($sql);
    echo json_encode([
        // 'sql' => $sql,
        'ket' => 'SUCCESS'
    ]);
} catch (PDOException $ex) {
    echo json_encode([
        // 'sql' => $sql,
        'ket' => $ex->getMessage() . $ex->getLine()
    ]);
}
