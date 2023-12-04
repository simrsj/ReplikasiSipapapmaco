<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";

// echo "<pre>";
// echo print_r($_POST);
// echo "</pre>";
$password = $_POST['password'];
$password_u = $_POST['password_u'];

$options = [
    'cost' => 5,
];
$password_hash = password_hash($password, PASSWORD_DEFAULT, $options);

if ($password != $password_u) {
    $hasil['ket'] = "T";
} else {
    $sql_update = "UPDATE tb_user SET";
    $sql_update .= " hash_password_user = '" . md5(date('Y-m-d', time()) . $_POST['idu']) . "',";
    $sql_update .= " password_user = '" . md5($password) . "'";
    $sql_update .= " WHERE id_user = " . base64_decode(urldecode($_POST['idu']));
    // echo $sql_update . "<br>";
    try {
        // $conn->query($sql_update);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA EMAIL USER-');";
        echo "document.location.href='?error404';</script>";
    }
    $hasil['ket'] = "Y";
}

echo json_encode($hasil);
