<?php
error_reporting(0);
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
$exp_ar_idprkn = explode('*sm*', base64_decode(urldecode(hex2bin($_POST['idprkn']))));
$idprkn = $exp_ar_idprkn[0];
$sql = "SELECT * FROM tb_praktikan WHERE id_praktikan= " . $idprkn;
// echo "$sql <br>";
try {
    $q = $conn->query($sql);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA PRAKTIKAN-');";
    echo "document.location.href='?error404';</script>";
}
$d = $q->fetch(PDO::FETCH_ASSOC);
$h['idprkn'] = bin2hex(urlencode(base64_encode($d["id_praktikan"] . "*sm*" . date('Y-m-d H:i:s', time()))));
$h['u_no_id'] = $d["no_id_praktikan"];
$h['u_nama'] = $d["nama_praktikan"];
$h['u_tgl'] = $d["tgl_lahir_praktikan"];
$h['u_telp'] = $d["telp_praktikan"];
$h['u_wa'] = $d["wa_praktikan"];
$h['u_email'] = $d["email_praktikan"];
$h['u_alamat'] = $d["alamat_praktikan"];

echo json_encode($h);

// echo "<pre>";
// print_r($h);
// echo "</pre>";
