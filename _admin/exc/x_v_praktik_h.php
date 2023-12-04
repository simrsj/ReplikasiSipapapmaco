<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$sql_p = "DELETE FROM tb_praktik";
$sql_p .= " WHERE id_praktik=" . base64_decode(urldecode($_POST['idp']));
$sql_ptgl = "DELETE FROM tb_praktik_tgl";
$sql_ptgl .= " WHERE id_praktik=" . base64_decode(urldecode($_POST['idp']));
$sql_mp = "DELETE FROM tb_mess_pilih";
$sql_mp .= " WHERE id_praktik=" . base64_decode(urldecode($_POST['idp']));
$sql_mptgl = "DELETE FROM tb_mess_tgl";
$sql_mptgl .= " WHERE id_praktik=" . base64_decode(urldecode($_POST['idp']));
$sql_tp = "DELETE FROM tb_tarif_pilih";
$sql_tp .= " WHERE id_praktik=" . base64_decode(urldecode($_POST['idp']));
$sql_b = "DELETE FROM tb_bayar";
$sql_b .= " WHERE id_praktik=" . base64_decode(urldecode($_POST['idp']));
$sql_pp = "DELETE FROM tb_pembimbing_pilih";
$sql_pp .= " WHERE id_praktik=" . base64_decode(urldecode($_POST['idp']));

// echo "$sql_p<br>";
// echo "$sql_ptgl<br>";
// echo "$sql_mp<br>";
// echo "$sql_mptgl<br>";
// echo "$sql_tp<br>";
// echo "$sql_b<br>";
// echo "$sql_pp<br>";
$conn->query($sql_p);
$conn->query($sql_ptgl);
$conn->query($sql_mp);
$conn->query($sql_mptgl);
$conn->query($sql_tp);
$conn->query($sql_b);
$conn->query($sql_pp);

echo json_encode(['success' => 'Sukses']);
