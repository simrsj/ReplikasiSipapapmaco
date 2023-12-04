<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql = "SELECT * FROM tb_tempat";
$sql .= " WHERE id_tempat= " . $_POST['id'];
// echo "$sql <br>";

$q = $conn->query($sql);
$d = $q->fetch(PDO::FETCH_ASSOC);
$h['u_id_tempat'] = $d["id_tempat"];
$h['u_id_tarif_jenis'] = $d["id_tarif_jenis"];
$h['u_nama_tempat'] = $d["nama_tempat"];
$h['u_kapasitas_tempat'] = $d["kapasitas_tempat"];
$h['u_id_jurusan_pdd_jenis'] = $d["id_jurusan_pdd_jenis"];
$h['u_tarif_tempat'] = $d["tarif_tempat"];
$h['u_id_tarif_satuan'] = $d["id_tarif_satuan"];
$h['u_ket_tempat'] = $d["ket_tempat"];
$h['u_status_tempat'] = $d["status_tempat"];

echo json_encode($h);

// echo "<pre>";
// print_r($h);
// echo "</pre>";
