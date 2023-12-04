<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
try {
    $sql = "UPDATE tb_logbook_ked_residen_pi SET ";
    $sql .= " tgl_ubah = '" . date('Y-m-d G:i:s') . "',";
    $sql .= " tgl = '" . $_POST['tgl'] . "',";
    $sql .= " semester = '" . $_POST['semester'] . "',";
    $sql .= " jenis = '" . $_POST['jenis'] . "',";
    $sql .= " judul = '" . $_POST['judul'] . "',";
    $sql .= " bim1 = '" . $_POST['bim1'] . "',";
    $sql .= " bim2 = '" . $_POST['bim2'] . "',";
    $sql .= " bim3 = '" . $_POST['bim3'] . "',";
    $sql .= " present = '" . $_POST['present'] . "',";
    $sql .= " pembimbing = '" . $_POST['pembimbing'] . "'";
    $sql .= " WHERE id = " . decryptString($_POST['idpr'], $customkey);
    $conn->query($sql);
    echo json_encode([
        'sql' => $sql,
        'ket' => 'SUCCESS'
    ]);
} catch (PDOException $ex) {
    echo json_encode([
        'sql' => $sql,
        'ket' => $ex->getMessage() . $ex->getLine()
    ]);
}
