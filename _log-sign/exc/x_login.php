<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$timezone = new DateTimeZone('Asia/Jakarta');
$date = new DateTime();
$date->setTimeZone($timezone);

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

session_start();

$sql = "SELECT *  FROM tb_user ";
$sql .= " WHERE username_user = '" . $_POST['username_user'] . "'";
$sql .= " AND password_user = '" . md5($_POST['password_user']) . "'";
// echo $sql . "<br>";
try {
    $q = $conn->query($sql);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA USER-');";
    echo "document.location.href='?error404';</script>";
}
$d = $q->fetch(PDO::FETCH_ASSOC);

$_SESSION['username_user'] = $d['username_user'];
$_SESSION['nama_user'] = $d['nama_user'];
$_SESSION['id_user'] = $d['id_user'];
$_SESSION['id_institusi'] = $d['id_institusi'];
$_SESSION['id_mou'] = $d['id_mou'];
$_SESSION['status_user'] = $d['status_user'];
$_SESSION['level_user'] = $d['level_user'];
// $_SESSION['id_mou'] = $row['id_mou'];

//eksekusi jika username dan password sesuai
$sql_update_login = "UPDATE tb_user";
$sql_update_login .= " SET terakhir_login_user = '" . $date->format("Y-m-d H:i:s") . "'";
$sql_update_login .= " WHERE id_user ='" . $_SESSION['id_user'] . "'";
// echo $sql_update_login . "<br>";
try {
    $conn->query($sql_update_login);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA LAST LOGIN-');";
    echo "document.location.href='?error404';</script>";
}
echo json_encode(['ket' => 'Y']);
