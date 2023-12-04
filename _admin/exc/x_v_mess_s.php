<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$sql = "INSERT INTO tb_mess (
    tgl_input_mess, 
    nama_mess, 
    kapasitas_t_mess,
    alamat_mess,
    nama_pemilik_mess,
    telp_pemilik_mess,
    email_pemilik_mess,
    tarif_tanpa_makan_mess,
    tarif_dengan_makan_mess,
    kepemilikan_mess,
    id_tarif_satuan,
    id_tarif_jenis,
    fasilitas_mess,
    status_mess
    ) VALUES (
        '" . date('Y-m-d', time()) . "',
        '" . $_POST['t_nama_mess'] . "', 
        '" . $_POST['t_kapsitas_total_mess'] . "', 
        '" . $_POST['t_alamat_mess'] . "', 
        '" . $_POST['t_nama_pemilik_mess'] . "', 
        '" . $_POST['t_telp_pemilik_mess'] . "', 
        '" . $_POST['t_email_pemilik_mess'] . "', 
        '" . $_POST['t_tarif_tanpa_makan_mess'] . "', 
        '" . $_POST['t_tarif_dengan_makan_mess'] . "', 
        '" . $_POST['t_kepemilikan_mess'] . "', 
        4, 
        7,
        '" . $_POST['t_fasilitas_mess'] . "',
        'Y'
    )";

// echo $sql . "<br>";
$conn->query($sql);
