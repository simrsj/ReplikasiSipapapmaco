<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
$id = $_POST['u_id_kuota'];

$sql = "UPDATE tb_kuota SET
    nama_kuota = '" . $_POST['u_nama_kuota'] . "',
    jumlah_kuota = '" . $_POST['u_jumlah_kuota'] . "', 
    ket_kuota = '" . $_POST['u_ket_kuota'] . "'
    WHERE id_kuota = " . $id;

echo $sql . "<br>";
$conn->query($sql);
