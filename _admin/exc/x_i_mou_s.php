<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$exp_arr_id_mou = explode("*sm*", base64_decode(urldecode(hex2bin($_POST['id_mou']))));
$id_mou = $exp_arr_id_mou[1];

// echo $tgl_selesai_mou . "<br>";
try {
    $sql_i_mou = "INSERT INTO tb_kerjasama (";
    $sql_i_mou .= " id, ";
    $sql_i_mou .= " id_institusi, ";
    $sql_i_mou .= " tgl_input_mou, ";
    $sql_i_mou .= " tgl_mulai_mou, ";
    $sql_i_mou .= " tgl_selesai_mou, ";
    $sql_i_mou .= " no_pks_rsj, ";
    $sql_i_mou .= " no_pks_institusi, ";
    $sql_i_mou .= " id_jurusan_pdd, ";
    $sql_i_mou .= " id_profesi_pdd, ";
    $sql_i_mou .= " id_jenjang_pdd ";
    $sql_i_mou .= " ) VALUES (";
    $sql_i_mou .= " '" . $id_mou . "',";
    $sql_i_mou .= " '" . $_POST['id_institusi'] . "',";
    $sql_i_mou .= " '" . date('Y-m-d', time()) . "',";
    $sql_i_mou .= " '" . $_POST['tgl_mulai_mou'] . "',";
    $sql_i_mou .= " '" . $_POST['tgl_selesai_mou'] . "',";
    $sql_i_mou .= " '" . $_POST['no_rsj_mou'] . "',";
    $sql_i_mou .= " '" . $_POST['no_institusi_mou'] . "',";
    $sql_i_mou .= " '" . $_POST['id_jurusan_pdd'] . "',";
    $sql_i_mou .= " '" . $_POST['id_profesi_pdd'] . "',";
    $sql_i_mou .= " '" . $_POST['id_jenjang_pdd'] . "'";
    $sql_i_mou .= " )";
    // echo "$sql_i_mou <br>";
    $conn->query($sql_i_mou);
} catch (Exception $ex) {
    echo "<script>alert('-MoU-');";
    echo "document.location.href='?error404';</script>";
}



echo json_encode(['success' => 'Sukses']);
