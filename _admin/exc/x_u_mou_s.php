<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// // var_dump($_POST);
// print_r($_POST);
// echo "</pre>";
$exp_arr_id_mou = explode("*sm*", base64_decode(urldecode(hex2bin($_POST['id_mou']))));
$id_mou = $exp_arr_id_mou[1];
try {
    $sql_u_mou = "UPDATE tb_kerjasama SET";
    $sql_u_mou .= " tgl_ubah_mou = '" . date('Y-m-d', time()) . "',";
    $sql_u_mou .= " tgl_mulai_mou = '" . $_POST['tgl_mulai_mou'] . "',";
    $sql_u_mou .= " tgl_selesai_mou = '" . $_POST['tgl_selesai_mou'] . "',";
    $sql_u_mou .= " no_pks_rsj = '" . $_POST['no_rsj_mou'] . "',";
    $sql_u_mou .= " no_pks_institusi = '" . $_POST['no_institusi_mou'] . "',";
    $sql_u_mou .= " id_jurusan_pdd = '" . $_POST['id_jurusan_pdd'] . "',";
    $sql_u_mou .= " id_profesi_pdd = '" . $_POST['id_profesi_pdd'] . "',";
    $sql_u_mou .= " id_jenjang_pdd = '" . $_POST['id_jenjang_pdd'] . "'";
    $sql_u_mou .= " WHERE id = " . $id_mou;
    // echo "$sql_u_mou <br>";
    $conn->query($sql_u_mou);
} catch (Exception $ex) {
    echo "<script>alert('-MoU-');";
    echo "document.location.href='?error404';</script>";
}


echo json_encode(['success' => 'Sukses']);
