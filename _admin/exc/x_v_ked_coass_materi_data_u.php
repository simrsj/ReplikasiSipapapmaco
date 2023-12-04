<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
try {
    $sql = "UPDATE tb_logbook_ked_coass_materi  SET ";
    $sql .= " tgl_ubah = '" . date('Y-m-d G:i:s') . "',";
    $sql .= " materi = '" . $_POST['materi'] . "',";
    $sql .= " tgl = '" . $_POST['tgl'] . "',";
    $sql .= " topik = '" . $_POST['topik'] . "',";
    $sql .= " lk = '" . $_POST['lk'] . "',";
    $sql .= " dosen_pembimbing = '" . $_POST['dosen_pembimbing'] . "'";
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
