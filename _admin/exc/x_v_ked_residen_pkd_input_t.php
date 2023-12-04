<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
$idpr = decryptString($_POST['idpr'], $customkey);
try {
    $sql = "INSERT INTO tb_logbook_ked_residen_pkd (";
    $sql .= " id,";
    $sql .= " id_praktikan,";
    $sql .= " tgl_tambah,";
    $sql .= " jenis,";
    $sql .= " tgl,";
    $sql .= " semester,";
    $sql .= " no_rm,";
    $sql .= " inisial,";
    $sql .= " icd10_diagnosis,";
    $sql .= " ket";
    $sql .= " ) VALUES (";
    $sql .= " 'NULL', ";
    $sql .= "'" . $idpr . "', ";
    $sql .= "'" . date('Y-m-d G:i:s') . "', ";
    $sql .= "'" . $_POST['jenis'] . "', ";
    $sql .= "'" . $_POST['tgl'] . "', ";
    $sql .= "'" . $_POST['semester'] . "', ";
    $sql .= "'" . $_POST['no_rm'] . "', ";
    $sql .= "'" . $_POST['inisial'] . "', ";
    $sql .= "'" . $_POST['icd10_diagnosis'] . "', ";
    $sql .= "'" . $_POST['ket'] . "' ";
    $sql .= ")";
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
