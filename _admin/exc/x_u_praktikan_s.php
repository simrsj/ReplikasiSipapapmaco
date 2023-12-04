<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";
$sql = "INSERT INTO tb_praktikan";
$sql .= " (id_praktik, nama_praktikan, no_id_praktikan, ";
$sql .= " telp_praktikan, wa_praktikan, email_praktikan, ";
$sql .= " kota_kab_praktikan, tgl_input_praktikan)";
$sql .= " VALUES";
$sql .= " ('" . $_POST['t_id_praktik'] . "', '" . $_POST['t_nama_praktikan'] . "', '" . $_POST['t_no_id_praktikan'] . "', ";
$sql .= " '" . $_POST['t_telp_praktikan'] . "','" . $_POST['t_wa_praktikan'] . "', '" . $_POST['t_email_praktikan'] . "',  ";
$sql .= " '" . $_POST['t_kota_kab_praktikan'] . "', '" . date('Y-m-d', time()) . "')";

echo "$sql <br>";
$q = $conn->query($sql);

json_encode(['success' => 'Sukses']);
