<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql = "UPDATE tb_praktik SET status_praktik = 'ARSIP' WHERE id_praktik = " . base64_decode(urldecode($_POST['idp']));
echo $sql;
$conn->query($sql);
