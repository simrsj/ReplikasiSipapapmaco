<?php
error_reporting(0);
require_once $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

try {
    $idu = decryptString($_POST['idu'], $customkey);
    $sql = "INSERT INTO tb_kuesioner_pertanyaan (";
    $sql .= " id,";
    $sql .= " pertanyaan,";
    $sql .= " tgl_tambah, ";
    $sql .= " ket ";
    $sql .= " ) VALUES (";
    $sql .= " NULL, ";
    $sql .= " '" . $_POST['t_pertanyaan'] . "', ";
    $sql .= " '" . date('Y-m-d G:i:s') . "',";
    $sql .= " '" . $_POST['t_ket'] . "'";
    $sql .= ")";
    $conn->query($sql);
    echo json_encode([
        // 'sql' => $sql,
        'ket' => 'success'
    ]);
} catch (Exception $ex) {
    echo json_encode([
        // 'sql' => $sql,
        'ket' => 'error'
    ]);
}
