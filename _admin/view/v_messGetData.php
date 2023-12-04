<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql = "SELECT * FROM tb_mess";
$sql .= " WHERE id_mess= " . $_POST['id'];
// echo "$sql <br>";

$q = $conn->query($sql);
$d = $q->fetch(PDO::FETCH_ASSOC);
$h['id_mess'] = $d["id_mess"];
$h['nama_mess'] = $d["nama_mess"];
$h['kapasitas_t_mess'] = $d["kapasitas_t_mess"];
$h['alamat_mess'] = $d["alamat_mess"];
$h['nama_pemilik_mess'] = $d["nama_pemilik_mess"];
$h['telp_pemilik_mess'] = $d["telp_pemilik_mess"];
$h['email_pemilik_mess'] = $d["email_pemilik_mess"];
$h['tarif_tanpa_makan_mess'] = $d["tarif_tanpa_makan_mess"];
$h['tarif_dengan_makan_mess'] = $d["tarif_dengan_makan_mess"];
$h['kepemilikan_mess'] = $d["kepemilikan_mess"];
$h['fasilitas_mess'] = $d["fasilitas_mess"];
$h['status_mess'] = $d["status_mess"];

echo json_encode($h);

// echo "<pre>";
// print_r($h);
// echo "</pre>";
