<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$id_tarif_pilih = base64_decode(urldecode($_POST['idptrf']));

$sql = "UPDATE tb_tarif_pilih SET";
$sql .= " id_praktik = '" . base64_decode(urldecode($_POST['idp']))  . "',";
$sql .= " tgl_ubah_tarif_pilih = '" . date('Y-m-d', time()) . "',";
$sql .= " nama_jenis_tarif_pilih = '" . $_POST[md5('u_jenis_tarif' . $id_tarif_pilih)] . "',";
$sql .= " nama_tarif_pilih = '" . $_POST[md5('u_nama' . $id_tarif_pilih)] . "', ";
$sql .= " nominal_tarif_pilih = '" . $_POST[md5('u_tarif' . $id_tarif_pilih)] . "',";
$sql .= " nama_satuan_tarif_pilih = '" . $_POST[md5('u_satuan' . $id_tarif_pilih)] . "',";
$sql .= " frekuensi_tarif_pilih = '" . $_POST[md5('u_frekuensi' . $id_tarif_pilih)] . "',";
$sql .= " kuantitas_tarif_pilih = '" . $_POST[md5('u_kuantitas' . $id_tarif_pilih)] . "',";
$sql .= " jumlah_tarif_pilih = '" . $_POST[md5('u_tarif' . $id_tarif_pilih)] * $_POST[md5('u_frekuensi' . $id_tarif_pilih)] * $_POST[md5('u_kuantitas' . $id_tarif_pilih)] . "',";
$sql .= " status_tarif_pilih = '" . $_POST[md5('u_status' . $id_tarif_pilih)] . "'";
$sql .= " WHERE id_tarif_pilih  = " . $id_tarif_pilih;

// echo $sql . "<br>";
try {
    $conn->query($sql);
} catch (Exception $ex) {
    echo "<script>alert('$ex -UPDATE DATA PRAKTIKAN-');";
    echo "document.location.href='?error404';</script>";
}

echo json_encode(['success' => 'Data berhasil Diubah']);
