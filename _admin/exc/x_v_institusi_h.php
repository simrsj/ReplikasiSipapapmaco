<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

$sql = "DELETE FROM tb_institusi";
$sql .= " WHERE id_institusi=" . $_POST['h_id_institusi'];

// echo "$sql<br>";
$conn->query($sql);

echo json_encode(['success' => 'Sukses']);
