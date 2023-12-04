<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
try {
    $sql = "SELECT *  FROM tb_logbook_ked_coass_psw WHERE id = " . decryptString($_POST['id'], $customkey);
    // $conn->query($sql);
    $d = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    echo json_encode([
        'ruang' => $d['ruang'],
        'nama' => $d['nama'],
        'usia' => $d['usia'],
        'dd' => $d['dd'],
        'diagnosis_kerja' => $d['diagnosis_kerja'],
        'terapi' => $d['terapi'],
        'ket' => 'SUCCESS'
    ]);
} catch (PDOException $ex) {
    echo json_encode([
        // 'sql' => $sql,
        'ket' => 'ERROR'
    ]);
}
