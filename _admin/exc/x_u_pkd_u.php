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

if ($d_prvl['u_pkd'] == "Y") {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $sql_update = "UPDATE tb_pkd SET ";
    $sql_update .= " tgl_ubah_pkd ='" . date('Y-m-d', time()) . "', ";
    $sql_update .= " nama_pemohon_pkd ='" . $_POST['pemohon'] . "', ";
    $sql_update .= " rincian_pkd = '" . $_POST['rincian'] . "', ";
    $sql_update .= " tgl_pel_pkd = '" . $_POST['tgl_pel'] . "', ";
    $sql_update .= " nama_kor_pkd =  '" . $_POST['nama_koordinator'] . "', ";
    $sql_update .= " email_kor_pkd =  '" . $_POST['email_koordinator'] . "', ";
    $sql_update .= " telp_kor_pkd = '" . $_POST['telp_koordinator'] . "' ";
    $sql_update .= " WHERE id_pkd = " . base64_decode(urldecode($_POST['idpkd']));
    $dataJSON['id'] = $_POST['idpkd'];
    $dataJSON['q'] = urlencode(base64_encode($sql_update));
    echo json_encode($dataJSON);
} else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}
