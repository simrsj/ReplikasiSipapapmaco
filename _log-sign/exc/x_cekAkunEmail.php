<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$sql = "SELECT email_user FROM tb_user WHERE email_user = '" . $_POST['email'] . "'";
// echo  $sql . "<br>";
try {
    $q = $conn->query($sql);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA EMAIL USER-');";
    echo "document.location.href='?error404';</script>";
}
$r = $q->rowCount();
// echo "baris:" . $r;


if ($r > 0) $h['ket'] = 'Y';
elseif ($r < 1) $h['ket'] = 'T';
else $h['ket'] = 'ERROR';

echo json_encode($h);
