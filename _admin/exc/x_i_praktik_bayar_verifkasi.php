<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
$sql = "UPDATE tb_bayar SET";
$sql .= " status_bayar ='" . $_POST['status'] . "'";
$sql .= " WHERE id_bayar=" . base64_decode(urldecode($_POST['idb']));

// echo "$sql <br>";
$q = $conn->query($sql);

json_encode(['success' => 'Sukses']);
