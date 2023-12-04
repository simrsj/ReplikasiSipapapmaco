<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
$idpr = decryptString($_POST['idpr'], $customkey);
try {
    $sql = "INSERT INTO tb_logbook_ked_residen_jkh (";
    $sql .= " id,";
    $sql .= " id_praktikan,";
    $sql .= " tgl_tambah,";
    $sql .= " tgl,";
    $sql .= " visite_besar,";
    $sql .= " rapat_klinik,";
    $sql .= " acara_ilmiah,";
    $sql .= " matkul_dosen,";
    $sql .= " j_pasien_rajal,";
    $sql .= " j_pasien_ranap";
    $sql .= " ) VALUES (";
    $sql .= " 'NULL', ";
    $sql .= "'" . $idpr . "', ";
    $sql .= "'" . date('Y-m-d G:i:s') . "', ";
    $sql .= "'" . $_POST['tgl'] . "', ";
    $sql .= "'" . $_POST['visite_besar'] . "', ";
    $sql .= "'" . $_POST['rapat_klinik'] . "', ";
    $sql .= "'" . $_POST['acara_ilmiah'] . "', ";
    $sql .= "'" . $_POST['matkul_dosen'] . "', ";
    $sql .= "'" . $_POST['j_pasien_rajal'] . "', ";
    $sql .= "'" . $_POST['j_pasien_ranap'] . "' ";
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
