<?php
error_reporting(0);
require_once $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

try {
    $sql = "DELETE FROM tb_kuesioner_pertanyaan";
    $sql .= " WHERE id=" . decryptString($_POST['id'], $customkey);
    $conn->query($sql);
    echo json_encode([
        // 'sql' => $sql,
        'ket' => "success"
    ]);
} catch (PDOException $ex) {
    echo json_encode([
        // 'sql' => $sql,
        'ket' => $ex->getMessage() . $ex->getLine()
    ]);
}
