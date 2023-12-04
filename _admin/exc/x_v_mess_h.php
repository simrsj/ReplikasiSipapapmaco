<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

$sql = "DELETE FROM tb_mess";
$sql .= " WHERE id_mess=" . $_POST['h_id_mess'];

// echo "$sql<br>";
$conn->query($sql);

echo json_encode(['success' => 'Sukses']);
