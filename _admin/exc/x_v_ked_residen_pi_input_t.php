<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
$idpr = decryptString($_POST['idpr'], $customkey);
try {
    $sql = "INSERT INTO tb_logbook_ked_residen_pi (";
    $sql .= " id,";
    $sql .= " id_praktikan,";
    $sql .= " tgl_tambah,";
    $sql .= " tgl,";
    $sql .= " semester,";
    $sql .= " jenis,";
    $sql .= " judul,";
    $sql .= " bim1,";
    $sql .= " bim2,";
    $sql .= " bim3,";
    $sql .= " present,";
    $sql .= " pembimbing";
    $sql .= " ) VALUES (";
    $sql .= " 'NULL', ";
    $sql .= "'" . $idpr . "', ";
    $sql .= "'" . date('Y-m-d G:i:s') . "', ";
    $sql .= "'" . $_POST['tgl'] . "', ";
    $sql .= "'" . $_POST['semester'] . "', ";
    $sql .= "'" . $_POST['jenis'] . "', ";
    $sql .= "'" . $_POST['judul'] . "', ";
    $sql .= "'" . $_POST['bim1'] . "', ";
    $sql .= "'" . $_POST['bim2'] . "', ";
    $sql .= "'" . $_POST['bim3'] . "', ";
    $sql .= "'" . $_POST['present'] . "', ";
    $sql .= "'" . $_POST['pembimbing'] . "' ";
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
