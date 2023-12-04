<?php
error_reporting(0);
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>" . print_r($_POST) . "</pre>";
$exp_arr_idp = explode("*sm*", base64_decode(urldecode(hex2bin($_POST['idp']))));
$idp = $exp_arr_idp[0];
$sql_praktik = "SELECT * FROM tb_praktik";
$sql_praktik .= " WHERE id_praktik = " . $idp;
// echo $sql_praktik . "<br>";
try {
    $q_praktik = $conn->query($sql_praktik);
    $d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC);
    $r_praktik = $q_praktik->rowCount();
} catch (Exception $ex) {
    echo "<script>alert('$ex -SIMPAN PRAKTIKAN-');";
    echo "document.location.href='?error404';</script>";
}

$sql_praktikan = "SELECT * FROM tb_praktikan";
$sql_praktikan .= " WHERE id_praktik = " . $idp;
// echo $sql_praktikan . "<br>";
try {
    $q_praktikan = $conn->query($sql_praktikan);
    // $d_praktikan = $q_praktikan->fetch(PDO::FETCH_ASSOC);
    $r_praktikan = $q_praktikan->rowCount();
} catch (Exception $ex) {
    echo "<script>alert('$ex -SIMPAN PRAKTIKAN-');";
    echo "document.location.href='?error404';</script>";
}

//Cari id Prkatikan
$sql_praktikan_id = "SELECT MAX(id_praktikan) AS ID FROM tb_praktikan";
// echo $sql_praktikan_id . "<br>";

try {
    $q_praktikan_id  = $conn->query($sql_praktikan_id);
    $d_praktikan_id  = $q_praktikan_id->fetch(PDO::FETCH_ASSOC);
    $id_praktikan = $d_praktikan_id['ID'] + 1;
} catch (Exception $ex) {
    echo "<script>alert('$ex -SIMPAN PRAKTIKAN-');";
    echo "document.location.href='?error404';</script>";
}
// echo $r_praktik . "asd" . $d_praktik['jumlah_praktik'];
if ($r_praktikan < $d_praktik['jumlah_praktik']) {

    $sql = "INSERT INTO tb_praktikan (";
    $sql .= " id_praktikan,";
    $sql .= " id_praktik,";
    $sql .= " tgl_tambah_praktikan,";
    $sql .= " no_id_praktikan,";
    $sql .= " nama_praktikan, ";
    $sql .= " tgl_lahir_praktikan, ";
    $sql .= " telp_praktikan,";
    $sql .= " wa_praktikan,";
    $sql .= " email_praktikan,";
    $sql .= " alamat_praktikan";
    $sql .= " ) VALUES (";
    $sql .= " '" . $id_praktikan . "', ";
    $sql .= " '" . $idp . "', ";
    $sql .= " '" . date('Y-m-d', time()) . "', ";
    $sql .= " '" . $_POST['t_no_id'] . "', ";
    $sql .= " '" . $_POST['t_nama'] . "',";
    $sql .= " '" . $_POST['t_tgl'] . "', ";
    $sql .= " '" . $_POST['t_telpon'] . "',";
    $sql .= " '" . $_POST['t_wa'] . "',";
    $sql .= " '" . $_POST['t_email'] . "',";
    $sql .= " '" . $_POST['t_alamat'] . "'";
    $sql .= " )";
    // echo $sql . "<br>";
    $dataJSON['idpp'] = bin2hex(urlencode(base64_encode(date("Ymd") . "*sm*" . $id_praktikan)));
    $dataJSON['q'] = bin2hex(urlencode(base64_encode(date("Ymd") . "*sm*" . $sql)));
    $dataJSON['ket'] = 'Y';
    echo json_encode($dataJSON);
} else {
    echo json_encode(['ket' => 'T']);
}
