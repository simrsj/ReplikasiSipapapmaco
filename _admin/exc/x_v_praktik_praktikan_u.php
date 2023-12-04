<?php
error_reporting(0);
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>" . print_r($_POST) . "</pre>";

$exp_ar_idprkn = explode('*sm*', base64_decode(urldecode(hex2bin($_POST['idprkn']))));
$idpp = $exp_ar_idprkn[0];
$sql = "UPDATE tb_praktikan SET";
$sql .= " no_id_praktikan = '" . $_POST['u_no_id'] . "',";
$sql .= " nama_praktikan = '" . $_POST['u_nama'] . "',";
$sql .= " tgl_lahir_praktikan = '" . $_POST['u_tgl'] . "', ";
$sql .= " telp_praktikan = '" . $_POST['u_telp'] . "',";
$sql .= " wa_praktikan = '" . $_POST['u_wa'] . "',";
$sql .= " email_praktikan = '" . $_POST['u_email'] . "',";
$sql .= " alamat_praktikan = '" . $_POST['u_alamat'] . "'";
$sql .= " WHERE id_praktikan = " . $idpp;
// echo $sql . "<br>";

$dataJSON['idpp'] = bin2hex(urlencode(base64_encode(date("Ymd") . "*sm*" . $idpp)));
$dataJSON['q'] = bin2hex(urlencode(base64_encode(date("Ymd") . "*sm*" . $sql)));
$dataJSON['ket'] = 'Y';
echo json_encode($dataJSON);
