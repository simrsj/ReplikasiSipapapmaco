<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql = "INSERT INTO tb_pembimbing (
    tgl_tambah_pembimbing, 
    no_id_pembimbing, 
    nama_pembimbing,
    id_pembimbing_jenis,
    id_jenjang_pdd,
    kali_pembimbing,
    status_pembimbing
    ) VALUES (
        '" . date('Y-m-d', time()) . "',
        '" . $_POST['t_nipnipk_pembimbing'] . "', 
        '" . $_POST['t_nama_pembimbing'] . "', 
        '" . $_POST['t_jenis_pembimbing'] . "', 
        '" . $_POST['t_jenjang_pembimbing'] . "',
        '" . $_POST['t_kali_pembimbing'] . "',
        'Y'
    )";

echo $sql . "<br>";
$conn->query($sql);
