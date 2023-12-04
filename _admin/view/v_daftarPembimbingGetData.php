<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql = "SELECT * FROM tb_pembimbing";
$sql .= " WHERE id_pembimbing= " . $_POST['id'];
// echo "$sql <br>";

$q = $conn->query($sql);
$d = $q->fetch(PDO::FETCH_ASSOC);
$h['id_pembimbing'] = $d["id_pembimbing"];
$h['no_id_pembimbing'] = $d["no_id_pembimbing"];
$h['nama_pembimbing'] = $d["nama_pembimbing"];
$h['id_pembimbing_jenis'] = $d["id_pembimbing_jenis"];
$h['id_jenjang_pdd'] = $d["id_jenjang_pdd"];
$h['kali_pembimbing'] = $d["kali_pembimbing"];
$h['status_pembimbing'] = $d["status_pembimbing"];

echo json_encode($h);

// echo "<pre>";
// print_r($h);
// echo "</pre>";
