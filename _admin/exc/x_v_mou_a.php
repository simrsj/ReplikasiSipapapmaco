<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$exp_arr_id = explode("*sm*", base64_decode(urldecode(hex2bin($_GET['id']))));
$id = $exp_arr_id[1];
try {
    $sql = "UPDATE tb_kerjasama SET";
    $sql .= " arsip = 'Y'";
    $sql .= " WHERE id = " . $id;
    // echo $sql . "<br>";
    $conn->query($sql);
} catch (Exception $ex) {
    echo "<script>alert('-ARSIP KERJASAMA-');";
    echo "document.location.href='?error404';</script>";
}
echo json_encode(['success' => 'Sukses']);
