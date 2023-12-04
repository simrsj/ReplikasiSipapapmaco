<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

$sql = "UPDATE tb_praktikan SET";
$sql .= " status_praktikan= 't'";
$sql .= " WHERE id_praktikan=" . $_POST['id_praktikan'];

echo "$sql<br>";
$conn->query($sql);

echo json_encode(['success' => 'Sukses']);
