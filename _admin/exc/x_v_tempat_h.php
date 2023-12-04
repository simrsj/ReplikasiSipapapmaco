<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

$sql = "DELETE FROM tb_tempat";
$sql .= " WHERE id_tempat=" . $_POST['id_tempat'];

// echo "$sql<br>";
$conn->query($sql);

echo json_encode(['success' => 'Sukses']);
