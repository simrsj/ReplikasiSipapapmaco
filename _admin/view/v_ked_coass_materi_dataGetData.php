<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
try {
    $sql = "SELECT *  FROM tb_logbook_ked_coass_materi WHERE id = " . decryptString($_POST['id'], $customkey);
    // $conn->query($sql);
    $d = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    echo json_encode([
        'materi' => $d['materi'],
        'tgl' => $d['tgl'],
        'topik' => $d['topik'],
        'lk' => $d['lk'],
        'dosen_pembimbing' => $d['dosen_pembimbing'],
        'ket' => 'SUCCESS'
    ]);
} catch (PDOException $ex) {
    echo json_encode([
        // 'sql' => $sql,
        'ket' => 'ERROR'
    ]);
}
