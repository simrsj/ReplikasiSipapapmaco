<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

echo "<pre>";
print_r($_POST);
echo "</pre>";

$sql = "UPDATE tb_mess SET";
$sql .= " tgl_ubah_mess = '" . date('Y-m-d', time()) . "',";
$sql .= " nama_mess = '" . $_POST['u_nama_mess'] . "',";
$sql .= " kapasitas_t_mess = '" . $_POST['u_kapasitas_total_mess'] . "',";
$sql .= " alamat_mess = '" . $_POST['u_alamat_mess'] . "',";
$sql .= " nama_pemilik_mess = '" . $_POST['u_nama_pemilik_mess'] . "',";
$sql .= " telp_pemilik_mess = '" . $_POST['u_telp_pemilik_mess'] . "',";
$sql .= " email_pemilik_mess = '" . $_POST['u_email_pemilik_mess'] . "',";
$sql .= " tarif_tanpa_makan_mess = '" . $_POST['u_tarif_tanpa_makan_mess'] . "',";
$sql .= " tarif_dengan_makan_mess = '" . $_POST['u_tarif_dengan_makan_mess'] . "',";
$sql .= " kepemilikan_mess = '" . $_POST['u_kepemilikan_mess'] . "',";
$sql .= " fasilitas_mess = '" . $_POST['u_fasilitas_mess'] . "',";
$sql .= " status_mess = '" . $_POST['u_status_mess'] . "'";
$sql .= " WHERE id_mess = " . $_POST['u_id_mess'];

echo $sql . "<br>";
$conn->query($sql);

json_encode(['success' => 'Sukses']);
