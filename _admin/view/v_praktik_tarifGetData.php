<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
error_reporting(0);
$sql = "SELECT * FROM tb_tarif_pilih";
$sql .= " WHERE id_tarif_pilih= " . base64_decode(urldecode($_POST['idptrf']));
// echo "$sql <br>";
try {
    $q = $conn->query($sql);
} catch (Exception $ex) {
    // echo $ex;
}
$d = $q->fetch(PDO::FETCH_ASSOC);
$h['id_tarif_pilih'] = $d["id_tarif_pilih"];
// $h['id_praktik'] = $d["id_praktik"];
$h['u_nama_jenis'] = $d["nama_jenis_tarif_pilih"];
$h['u_nama'] = $d["nama_tarif_pilih"];
$h['u_tarif'] = $d["nominal_tarif_pilih"];
$h['u_satuan'] = $d["nama_satuan_tarif_pilih"];
$h['u_frekuensi'] = $d["frekuensi_tarif_pilih"];
$h['u_kuantitas'] = $d["kuantitas_tarif_pilih"];
$h['u_status'] = $d["status_tarif_pilih"];
// echo "<pre>".print_r($h)."</pre>";
echo json_encode($h);
