<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
$idpr = decryptString($_POST['idpr'], $customkey);
try {
    $sql = "INSERT INTO tb_logbook_ked_coass_materi VALUES (";
    $sql .= "NULL, ";
    $sql .= "'" . $idpr . "', ";
    $sql .= "'" . date('Y-m-d G:i:s') . "', ";
    $sql .= "NULL, ";
    $sql .= "'" . $_POST['materi'] . "', ";
    $sql .= "'" . $_POST['tgl'] . "', ";
    $sql .= "'" . $_POST['topik'] . "', ";
    $sql .= "'" . $_POST['lk'] . "', ";
    $sql .= "'" . $_POST['dosen_pembimbing'] . "' ";
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
