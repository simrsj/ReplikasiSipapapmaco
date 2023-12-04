<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$sql = "SELECT *  FROM tb_user ";
$sql .= " WHERE username_user = '" . $_POST['username_user'] . "'";
$sql .= " AND password_user = '" . md5($_POST['password_user']) . "'";
// echo  $sql . "<br>";
try {
    $q = $conn->query($sql);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA USER-');";
    echo "document.location.href='?error404';</script>";
}
$r = $q->rowCount();
// echo "baris:" . $r;


if ($r > 0) $h['ket'] = 'Y';
elseif ($r < 1) $h['ket'] = 'T';
else $h['ket'] = 'ERROR';

echo json_encode($h);
