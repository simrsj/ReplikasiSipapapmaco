<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql = "SELECT * FROM tb_kuota";
$sql .= " WHERE id_kuota= " . $_POST['id'];
// echo "$sql <br>";

$q = $conn->query($sql);
$d = $q->fetch(PDO::FETCH_ASSOC);
$h['id_kuota'] = $d["id_kuota"];
$h['nama_kuota'] = $d["nama_kuota"];
$h['jumlah_kuota'] = $d["jumlah_kuota"];
$h['ket_kuota'] = $d["ket_kuota"];

echo json_encode($h);

// echo "<pre>";
// print_r($h);
// echo "</pre>";
