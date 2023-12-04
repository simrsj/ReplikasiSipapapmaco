<?php

include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$exp_arr_idp = explode("*sm*", base64_decode(urldecode(hex2bin($_POST['idp']))));
$idp = $exp_arr_idp[1];

$sql_update = "UPDATE tb_praktik SET";
$sql_update .= " alasan_admin =  '" . $_POST['ket' . $_POST['encrypt']] . "', ";
$sql_update .= " status_alasan = '" . $_POST['radio' . $_POST['encrypt']] . "'";
$sql_update .= " WHERE id_praktik = " . $idp;
// echo $sql_update . "<br>";
try {
    $conn->query($sql_update);
    echo json_encode(['success' => 'Data Alasan Mess Praktik Berhasil Diubah']);
} catch (Exception $ex) {
    echo "<script>alert('Data Alasan Mess Praktik-');";
    echo "document.location.href='?error404';</script>";
}
