<?php

include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
// include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/csrf.php";

//data privileges 
$sql_prvl = "SELECT * FROM tb_user_privileges WHERE id_user = " . base64_decode(urldecode($_POST['idu']));
try {
    $q_prvl = $conn->query($sql_prvl);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA PRIVILEGES-');";
    echo "document.location.href='?error404';</script>";
}
$d_prvl = $q_prvl->fetch(PDO::FETCH_ASSOC);

if ($d_prvl['c_pkd'] == "Y") {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $sql_insert = "INSERT INTO tb_pkd_tarif ( ";
    $sql_insert .= " id_pkd, ";
    $sql_insert .= " tgl_tambah_pkd_tarif, ";
    $sql_insert .= " nama_pkd_tarif, ";
    $sql_insert .= " frekuensi_pkd_tarif, ";
    $sql_insert .= " satuan_pkd_tarif, ";
    $sql_insert .= " jumlah_pkd_tarif, ";
    $sql_insert .= " total_pkd_tarif";
    $sql_insert .= " ) VALUES (";
    $sql_insert .= " '" . base64_decode(urldecode($_POST['idpkd'])) . "', ";
    $sql_insert .= " '" . date('Y-m-d', time()) . "', ";
    $sql_insert .= " '" . $_POST['t_nama'] . "', ";
    $sql_insert .= " '" . $_POST['t_frek'] . "', ";
    $sql_insert .= " '" . $_POST['t_satuan'] . "', ";
    $sql_insert .= " '" . $_POST['t_tarif'] . "', ";
    $sql_insert .= " '" . $_POST['t_frek'] * $_POST['t_tarif'] . "'";
    $sql_insert .= " )";
    // echo $sql_insert . "<br>";
    $conn->query($sql_insert);
    echo json_encode(["Ket" => "Berhasil Tersimpan"]);
} else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}
