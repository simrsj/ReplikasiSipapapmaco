<?php

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql = "UPDATE tb_praktik SET status_praktik = 'Y' WHERE id_praktik = " . $_POST['id'];


json_encode(['success' => 'Sukses']);
// echo "$sql<br>";
$conn->query($sql);
