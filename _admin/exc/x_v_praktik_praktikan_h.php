<?php
error_reporting(0);
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$exp_ar_idpp = explode('*sm*', base64_decode(urldecode(hex2bin($_POST['idprkn']))));
$idpp = $exp_ar_idpp[0];
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$sql = "DELETE FROM tb_praktikan ";
$sql .= " WHERE id_praktikan=" . $idpp;

// echo "$sql<br>";
try {
    $conn->query($sql);
} catch (Exception $ex) {
    echo "<script>alert('$ex -UPDATE DATA PRAKTIKAN-');";
    echo "document.location.href='?error404';</script>";
}

echo json_encode(['success' => 'Data berhasil Dihapus']);
