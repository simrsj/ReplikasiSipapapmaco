<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql = "SELECT * FROM tb_pkd_tarif";
$sql .= " WHERE id_pkd_tarif= " . base64_decode(urldecode($_POST['idpkdt']));
// echo "$sql <br>";
try {
    $q = $conn->query($sql);
    $d = $q->fetch(PDO::FETCH_ASSOC);
    $h['idpkdt'] = $d["id_pkd_tarif"];
    $h['u_nama'] = $d["nama_pkd_tarif"];
    $h['u_frek'] = $d["frekuensi_pkd_tarif"];
    $h['u_satuan'] = $d["satuan_pkd_tarif"];
    $h['u_jumlah'] = $d["jumlah_pkd_tarif"];
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA PKD TARIF');";
    echo "document.location.href='?error404';</script>";
}

echo json_encode($h);

// echo "<pre>";
// print_r($h);
// echo "</pre>";
