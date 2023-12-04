<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$sql = "UPDATE tb_user SET";
$sql .= " tgl_ubah_user = '" . date('Y-m-d G:i:s') . "',";
$sql .= " nama_user = '" . $_POST['u_nama'] . "',";
$sql .= " email_user = '" . $_POST['u_email'] . "', ";
$sql .= " no_telp_user = '" . $_POST['u_telp'] . "',";
$sql .= " username_user = '" . $_POST['u_username'] . "',";
$sql .= " password_user = '" . MD5($_POST['u_password']) . "', ";
$sql .= " level_user = '" . $_POST['u_level'] . "', ";
$sql .= " status_user = '" . $_POST['u_status'] . "'";
$sql .= " WHERE id_user = " . $_POST['u_id_user'];

// echo $sql . "<br>";
$conn->query($sql);
echo json_encode(['success' => 'Data Berhasil Diubah']);
