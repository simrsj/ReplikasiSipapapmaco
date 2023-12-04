<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$sql = "DELETE FROM tb_tarif_pilih ";
$sql .= " WHERE id_tarif_pilih=" . base64_decode(urldecode($_POST['idptrf']));

// echo "$sql<br>";
try {
    $conn->query($sql);
} catch (Exception $ex) {
    echo "<script>alert('$ex -UPDATE DATA TARIF PILIH-');";
    echo "document.location.href='?error404';</script>";
}

echo json_encode(['success' => 'Data berhasil Dihapus']);
