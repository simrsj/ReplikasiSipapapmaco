<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";
if ($_POST['id_user'] != 1) {
    $sql = "DELETE FROM tb_user WHERE id_user=" . $_POST['id_user'];
    $sql1 = "DELETE FROM tb_user_privileges WHERE id_user=" . $_POST['id_user'];

    // echo "$sql<br>";
    $conn->query($sql);
    $conn->query($sql1);
}
echo json_encode(['success' => 'Sukses']);
