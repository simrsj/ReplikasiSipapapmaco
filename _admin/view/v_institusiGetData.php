<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql = "SELECT * FROM tb_institusi";
$sql .= " WHERE id_institusi= " . $_POST['id'];
// echo "$sql <br>";

$q = $conn->query($sql);
$d = $q->fetch(PDO::FETCH_ASSOC);
$h['id_institusi'] = $d["id_institusi"];
$h['nama_institusi'] = $d["nama_institusi"];
$h['akronim_institusi'] = $d["akronim_institusi"];
$h['logo_institusi'] = $d["logo_institusi"];
$h['alamat_institusi'] = $d["alamat_institusi"];
$h['akred_institusi'] = $d["akred_institusi"];
$h['tglAkhirAkred_institusi'] = $d["tglAkhirAkred_institusi"];
$h['fileAkred_institusi'] = $d["fileAkred_institusi"];
$h['messOpsional_institusi'] = $d["messOpsional_institusi"];

echo json_encode($h);

// echo "<pre>";
// print_r($h);
// echo "</pre>";
