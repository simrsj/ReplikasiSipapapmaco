<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
$idpt = decryptString($_POST['idpt'], $customkey);
try {
    $sql = "INSERT INTO tb_kuesioner_jawaban (";
    $sql .= " id,";
    $sql .= " id_pertanyaan,";
    $sql .= " tgl_tambah,";
    $sql .= " jawaban,";
    $sql .= " nilai";
    $sql .= " ) VALUES (";
    $sql .= " 'NULL', ";
    $sql .= "'" . $idpt . "', ";
    $sql .= "'" . date('Y-m-d G:i:s') . "', ";
    $sql .= "'" . $_POST['jawaban'] . "', ";
    $sql .= "'" . $_POST['nilai'] . "' ";
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
