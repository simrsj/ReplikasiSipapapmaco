<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
$idpr = decryptString($_POST['idpr'], $customkey);
try {
    $sql = "INSERT INTO tb_logbook_ked_coass_kyd VALUES (";
    $sql .= "NULL, ";
    $sql .= "'" . $idpr . "', ";
    $sql .= "'" . date('Y-m-d G:i:s') . "', ";
    $sql .= "NULL, ";
    $sql .= "'" . $_POST['ruang'] . "', ";
    $sql .= "'" . $_POST['tgl'] . "', ";
    $sql .= "'" . $_POST['nama_pasien'] . "', ";
    $sql .= "'" . $_POST['usia'] . "', ";
    $sql .= "'" . $_POST['jenis_kelamin'] . "', ";
    $sql .= "'" . $_POST['medrec'] . "', ";
    $sql .= "'" . $_POST['diagnosis'] . "', ";
    $sql .= "'" . $_POST['terapi'] . "' ";
    $sql .= ")";
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
