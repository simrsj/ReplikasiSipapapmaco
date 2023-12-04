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

    //Cari id_pkd
    $sql_id_pkd = "SELECT MAX(id_pkd) AS ID FROM tb_pkd";
    // echo $sql_id_pkd . "<br>";
    try {
        $q_id_pkd  = $conn->query($sql_id_pkd);
        $d_id_pkd  = $q_id_pkd->fetch(PDO::FETCH_ASSOC);
        $id_pkd = $d_id_pkd['ID'] + 1;
    } catch (Exception $ex) {
        echo "<script>alert('$ex -ID PKD-');";
        echo "document.location.href='?error404';</script>";
    }

    $sql_insert = "INSERT INTO tb_pkd ( ";
    $sql_insert .= " id_pkd, ";
    $sql_insert .= " tgl_tambah_pkd, ";
    $sql_insert .= " nama_pemohon_pkd, ";
    $sql_insert .= " rincian_pkd, ";
    $sql_insert .= " tgl_pel_pkd, ";
    $sql_insert .= " nama_kor_pkd, ";
    $sql_insert .= " email_kor_pkd, ";
    $sql_insert .= " telp_kor_pkd ";
    $sql_insert .= " ) VALUES (";
    $sql_insert .= " '" . $id_pkd . "', ";
    $sql_insert .= " '" . date('Y-m-d', time()) . "', ";
    $sql_insert .= " '" . $_POST['pemohon'] . "', ";
    $sql_insert .= " '" . $_POST['rincian'] . "', ";
    $sql_insert .= " '" . $_POST['tgl_pel'] . "', ";
    $sql_insert .= " '" . $_POST['nama_koordinator'] . "', ";
    $sql_insert .= " '" . $_POST['email_koordinator'] . "', ";
    $sql_insert .= " '" . $_POST['telp_koordinator'] . "' ";
    $sql_insert .= " )";
    // echo $sql_insert . "<br>";
    $dataJSON['id'] = urlencode(base64_encode($id_pkd));
    $dataJSON['q'] = urlencode(base64_encode($sql_insert));
    echo json_encode($dataJSON);
} else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}
