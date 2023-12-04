<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

$sql = "DELETE FROM tb_pembimbing";
$sql .= " WHERE id_pembimbing=" . $_POST['h_id_pembimbing'];

// echo "$sql<br>";
$conn->query($sql);

echo json_encode(['success' => 'Sukses']);
