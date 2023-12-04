<?php

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
$sql_prvl = "SELECT * FROM tb_user_privileges";
$sql_prvl .= " WHERE id_user = " . base64_decode(urldecode($_POST['idu']));
try {
    $d_prvl = $conn->query($sql_prvl)->fetch(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    echo "<script>alert('Unauthorized');";
    echo "document.location.href='?error404';</script>";
}

if ($d_prvl['c_praktik_bayar'] == 'Y') {
    $sql_insert_bayar = "INSERT INTO tb_bayar (";
    $sql_insert_bayar .= " id_bayar,";
    $sql_insert_bayar .= " id_praktik,";
    $sql_insert_bayar .= " kode_bayar,";
    $sql_insert_bayar .= " atas_nama_bayar,";
    $sql_insert_bayar .= " noRek_bayar,";
    $sql_insert_bayar .= " melalui_bayar,";
    $sql_insert_bayar .= " tgl_transfer_bayar,";
    $sql_insert_bayar .= " tgl_input_bayar,";
    $sql_insert_bayar .= " ket_bayar";
    $sql_insert_bayar .= " ) VALUES (";
    $sql_insert_bayar .= " '" . base64_decode(urldecode($_POST['idb'])) . "',";
    $sql_insert_bayar .= " '" . base64_decode(urldecode($_POST['idp'])) . "',";
    $sql_insert_bayar .= " '" . $_POST['t_kode'] . "',";
    $sql_insert_bayar .= " '" . $_POST['t_atasNama'] . "',";
    $sql_insert_bayar .= " '" . $_POST['t_noRek'] . "',";
    $sql_insert_bayar .= " '" . $_POST['t_melalui'] . "',";
    $sql_insert_bayar .= " '" . $_POST['t_tglTF'] . "',";
    $sql_insert_bayar .= " '" . date('Y-m-d H:i:s', time()) . "',";
    $sql_insert_bayar .= " '" . $_POST['t_ket'] . "'";
    $sql_insert_bayar .= " )";
    // echo $sql_insert_bayar . "<br>";

    //Eksekusi Query
    try {
        $conn->query($sql_insert_bayar);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -INSERT TARIF MESS-');";
        echo "document.location.href='?error404';</script>";
    }
} else {
    echo "<script>alert('Unauthorized');document.location.href='?error401';</script>";
}
