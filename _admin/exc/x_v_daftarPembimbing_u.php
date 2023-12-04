<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql = "UPDATE tb_pembimbing SET";
$sql .= " tgl_ubah_pembimbing = '" . date('Y-m-d', time()) . "',";
$sql .= " no_id_pembimbing = '" . $_POST['u_nipnipk_pembimbing'] . "',";
$sql .= " nama_pembimbing = '" . $_POST['u_nama_pembimbing'] . "', ";
$sql .= " id_pembimbing_jenis = '" . $_POST['u_jenis_pembimbing'] . "',";
$sql .= " id_jenjang_pdd = '" . $_POST['u_jenjang_pembimbing'] . "',";
$sql .= " kali_pembimbing = '" . $_POST['u_kali_pembimbing'] . "',";
$sql .= " status_pembimbing = '" . $_POST['u_status_pembimbing'] . "'";
$sql .= " WHERE id_pembimbing = " . $_POST['u_id_pembimbing'];

// echo $sql . "<br>";
$conn->query($sql);

json_encode(['success' => 'Sukses']);
