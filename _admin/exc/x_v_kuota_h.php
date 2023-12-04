<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

$sql = "DELETE FROM tb_kuota";
$sql .= " WHERE id_kuota=" . $_POST['id_kuota'];

// echo "$sql<br>";
$conn->query($sql);

echo json_encode(['success' => 'Sukses']);
