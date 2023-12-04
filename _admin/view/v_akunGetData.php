<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
// include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";

$sql = "SELECT * FROM tb_user WHERE id_user= " . $_POST['id'];
// echo "$sql <br>";

$q = $conn->query($sql);
$d = $q->fetch(PDO::FETCH_ASSOC);
$h['id_user'] = $d["id_user"];
$h['nama_user'] = $d["nama_user"];
$h['email_user'] = $d["email_user"];
$h['no_telp_user'] = $d["no_telp_user"];
$h['level_user'] = $d["level_user"];
$h['username_user'] = $d["username_user"];
$h['foto_user'] = $d["foto_user"];
$h['status_user'] = $d["status_user"];

echo json_encode($h);

// echo "<pre>";
// print_r($h);
// echo "</pre>";
