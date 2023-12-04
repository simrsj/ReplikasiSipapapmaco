<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql = "INSERT INTO tb_kuota (
    tgl_tambah_kuota, 
    nama_kuota, 
    jumlah_kuota,
    ket_kuota
    ) VALUES (
        '" . date('Y-m-d', time()) . "', 
        '" . $_POST['t_nama_kuota'] . "', 
        '" . $_POST['t_jumlah_kuota'] . "', 
        '" . $_POST['t_ket_kuota'] . "'
    )";

echo $sql . "<br>";
$conn->query($sql);
