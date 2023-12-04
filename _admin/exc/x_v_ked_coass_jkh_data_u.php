<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
$i = 0;
try {
    $sql = "UPDATE tb_logbook_ked_coass_jkh SET ";
    $sql .= " tgl_ubah = '" . date('Y-m-d G:i:s') . "',";
    $sql .= " tgl = '" . $_POST['tgl'] . "',";
    $sql .= " kegiatan = '" . $_POST['kegiatan'] . "',";
    $sql .= " topik = '" . $_POST['topik'] . "'";
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
