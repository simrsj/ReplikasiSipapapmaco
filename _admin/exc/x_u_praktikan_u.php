<?php
error_reporting(0);
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";
$sql = "UPDATE tb_praktikan SET";
$sql .= " nama_praktikan='" . $_POST['nama_praktikan'] . "', ";
$sql .= " no_id_praktikan='" . $_POST['no_id_praktikan'] . "', ";
$sql .= " telp_praktikan='" . $_POST['telp_praktikan'] . "', ";
$sql .= " wa_praktikan='" . $_POST['wa_praktikan'] . "', ";
$sql .= " email_praktikan='" . $_POST['email_praktikan'] . "', ";
$sql .= " kota_kab_praktikan='" . $_POST['kota_kab_praktikan'] . "', ";
$sql .= " tgl_ubah_praktikan='" . date('Y-m-d', time()) . "'";
$sql .= " WHERE id_praktikan=" . $_POST['id_praktikan'];

echo "$sql <br>";
$q = $conn->query($sql);

json_encode(['success' => 'Sukses']);
