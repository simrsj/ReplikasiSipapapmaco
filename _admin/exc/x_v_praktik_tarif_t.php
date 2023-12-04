<?php

include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
$id_praktik = base64_decode(urldecode($_POST['idp']));

$sql = "INSERT INTO tb_tarif_pilih (";
$sql .= " id_praktik,";
$sql .= " tgl_tambah_tarif_pilih,";
$sql .= " nama_jenis_tarif_pilih,";
$sql .= " nama_tarif_pilih, ";
$sql .= " nominal_tarif_pilih, ";
$sql .= " nama_satuan_tarif_pilih,";
$sql .= " frekuensi_tarif_pilih,";
$sql .= " kuantitas_tarif_pilih,";
$sql .= " jumlah_tarif_pilih";
$sql .= " ) VALUES (";
$sql .= " '" . $id_praktik . "', ";
$sql .= " '" . date('Y-m-d', time()) . "', ";
$sql .= " '" . $_POST[md5('t_jenis_tarif' . $id_praktik)] . "', ";
$sql .= " '" . $_POST[md5('t_nama' . $id_praktik)] . "', ";
$sql .= " '" . $_POST[md5('t_tarif' . $id_praktik)] . "', ";
$sql .= " '" . $_POST[md5('t_satuan' . $id_praktik)] . "', ";
$sql .= " '" . $_POST[md5('t_frekuensi' . $id_praktik)] . "', ";
$sql .= " '" . $_POST[md5('t_kuantitas' . $id_praktik)] . "', ";
$sql .= " '" . $_POST[md5('t_tarif' . $id_praktik)] * $_POST[md5('t_frekuensi' . $id_praktik)] * $_POST[md5('t_kuantitas' . $id_praktik)] . "'";
$sql .= " )";
// echo $sql . "<br>";
try {
    $conn->query($sql);
} catch (Exception $ex) {
    echo "<script>alert('$ex -SIMPAN PILIH TARIF-');";
    echo "document.location.href='?error404';</script>";
}

echo json_encode(['success' => 'Data Berhasil Disimpan']);
