<?php

include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/vendor/autoload.php";
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";

# ------------------------------------------------------------------------------------------------------------------------------------- VARIABLE
$id_praktik = base64_decode(urldecode($_GET['idp']));

//logo Gambar
$img =  $_SERVER['DOCUMENT_ROOT'] . '/SM/_img/logopemprov.png';

//logo Gambar
$tte_elly =  $_SERVER['DOCUMENT_ROOT'] . '/SM/_img/tte/elly_marliani.jpeg';

//no surat
$noSurat =   (int)$_GET['ns'];

//kepada
$kepada =  $_GET['k'];

# ------------------------------------------------------------------------------------------------------------------------------------- EXC. DATABASE
$sql_praktik = "SELECT * FROM tb_praktik";
$sql_praktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
$sql_praktik .= " WHERE id_praktik = " . $id_praktik;
// echo $sql_praktik;
try {
    $q_praktik = $conn->query($sql_praktik);
} catch (Exception $ex) {
    echo "<script> alert('$ex -DATA praktik-'); ";
    echo "document.location.href='?error404'; </script>";
}
$d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC);

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('p_praktik_invoiceDOCX(PHPWord).docx');

//cari Jenis kegiatan 
$sql_getJenisKegiatan = "SELECT nama_jenis_tarif_pilih FROM tb_tarif_pilih ";
$sql_getJenisKegiatan .= " WHERE id_praktik = " . $id_praktik;
$sql_getJenisKegiatan .= " AND ujian_tarif_pilih IS NULL";
$sql_getJenisKegiatan .= " AND mess_tarif_pilih IS NULL";
$sql_getJenisKegiatan .= " GROUP BY nama_jenis_tarif_pilih";
$q_getJenisKegiatan = $conn->query($sql_getJenisKegiatan);

$data_invoice = "DATA TABEL RAB";

$templateProcessor->setValues([
    'tanggal' => tanggal(date('Y-m-d', time())),
    'tahun' => date('Y'),
    'ip' => ucwords(strtolower($d_praktik['nama_institusi'])),
    'kepada' => $kepada,
    'no_surat' => $noSurat,
    'no_surat_ip' => $d_praktik['no_surat_praktik'],
    'tgl_surat_ip' => tanggal($d_praktik['tgl_surat_praktik']),
    'tgl_mulai' => tanggal($d_praktik['tgl_mulai_praktik']),
    'tgl_selesai' => tanggal($d_praktik['tgl_selesai_praktik']),
    'jumlah_praktik' => $d_praktik['jumlah_praktik'],
    'data_invoice' => $data_invoice,
]);

header("Content-Disposition: attachment; filename=Invoice-RAB.docx");

$templateProcessor->saveAs('php://output');
