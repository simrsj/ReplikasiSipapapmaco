<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql = "UPDATE tb_tempat SET";
$sql .= " nama_tempat = '" . $_POST['u_nama_tempat'] . "',";
$sql .= " kapasitas_tempat = '" . $_POST['u_kapasitas_tempat'] . "', ";
$sql .= " id_jurusan_pdd_jenis = '" . $_POST['u_jenis_jurusan'] . "',";
$sql .= " tarif_tempat = '" . $_POST['u_tarif_tempat'] . "',";
$sql .= " id_tarif_satuan = '" . $_POST['u_tarif_satuan'] . "',";
$sql .= " status_tempat = '" . $_POST['u_status_tempat'] . "',";
$sql .= " ket_tempat = '" . $_POST['u_ket_tempat'] . "'";
$sql .= " WHERE id_tempat = " . $_POST['u_id_tempat'];

// echo $sql . "<br>";
$conn->query($sql);
