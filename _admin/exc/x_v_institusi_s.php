<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql = "INSERT INTO tb_institusi (
    id_institusi,
    tgl_tambah_institusi, 
    nama_institusi, 
    akronim_institusi,
    alamat_institusi,
    akred_institusi,
    tglAkhirAkred_institusi,
    messOpsional_institusi
    ) VALUES (
        '" . $_POST['id_institusi'] . "', 
        '" . date('Y-m-d G:i:s') . "', 
        '" . $_POST['t_nama_institusi'] . "', 
        '" . $_POST['t_akronim_institusi'] . "', 
        '" . $_POST['t_alamat_institusi'] . "',
        '" . $_POST['t_akred_institusi'] . "',
        '" . $_POST['t_tglAkhirAkred_institusi'] . "',
        '" . $_POST['t_messOpsional_institusi'] . "'
    )";

// echo $sql . "<br>";
$conn->query($sql);
echo json_encode(['success' => 'Data Institusi Berhasil Disimpan']);
