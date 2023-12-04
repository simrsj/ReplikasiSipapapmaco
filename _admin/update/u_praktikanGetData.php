<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql = "SELECT * FROM tb_praktikan";
$sql .= " WHERE id_praktikan= " . $_POST['id'];
// echo "$sql <br>";

$q = $conn->query($sql);
$d = $q->fetch(PDO::FETCH_ASSOC);
$h['id_praktikan'] = $d["id_praktikan"];
$h['nama_praktikan'] = $d["nama_praktikan"];
$h['no_id_praktikan'] = $d["no_id_praktikan"];
$h['telp_praktikan'] = $d["id_praktikan"];
$h['wa_praktikan'] = $d["wa_praktikan"];
$h['email_praktikan'] = $d["email_praktikan"];
$h['kota_kab_praktikan'] = $d["kota_kab_praktikan"];

echo json_encode($h);

// echo "<pre>";
// print_r($h);
// echo "</pre>";
