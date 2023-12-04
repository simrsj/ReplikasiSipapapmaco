<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql = "INSERT INTO tb_tempat (
    tgl_input_tempat, 
    id_tarif_jenis, 
    nama_tempat, 
    kapasitas_tempat,
    id_jurusan_pdd_jenis,
    tarif_tempat,
    id_tarif_satuan,
    ket_tempat,
    status_tempat
    ) VALUES (
        '" . date('Y-m-d', time()) . "', 
        '7', 
        '" . $_POST['t_nama_tempat'] . "', 
        '" . $_POST['t_kapasitas_tempat'] . "', 
        '" . $_POST['t_jenis_jurusan'] . "',
        '" . $_POST['t_tarif_tempat'] . "',
        '" . $_POST['t_tarif_satuan'] . "',
        '" . $_POST['t_ket_tempat'] . "',
        'Y'
    )";

// echo $sql . "<br>";
$conn->query($sql);
