<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
$exp_arr_idprkn = explode("*sm*", base64_decode(urldecode(hex2bin($_POST['idprkn']))));
$idprkn = $exp_arr_idprkn[1];
try {
    $sql_update = "UPDATE tb_kep_nil_lap_pen SET ";
    $sql_update .= " tgl_ubah = '" . date('Y-m-d', time()) . "', ";
    $sql_update .= " A1 = '" . $_POST['A1'] . "', ";
    $sql_update .= " A2 = '" . $_POST['A2'] . "', ";
    $sql_update .= " A3 = '" . $_POST['A3'] . "', ";
    $sql_update .= " A4 = '" . $_POST['A4'] . "', ";
    $sql_update .= " B1 = '" . $_POST['B1'] . "', ";
    $sql_update .= " B2 = '" . $_POST['B2'] . "', ";
    $sql_update .= " B3 = '" . $_POST['B3'] . "', ";
    $sql_update .= " B4 = '" . $_POST['B4'] . "', ";
    $sql_update .= " B5 = '" . $_POST['B5'] . "', ";
    $sql_update .= " B6 = '" . $_POST['B6'] . "', ";
    $sql_update .= " C1 = '" . $_POST['C1'] . "', ";
    $sql_update .= " C2 = '" . $_POST['C2'] . "', ";
    $sql_update .= " C3 = '" . $_POST['C3'] . "' ";
    $sql_update .= " WHERE id_praktikan = '" . $idprkn . "'";
    // echo $sql_update . "<br>";
    $conn->query($sql_update);
    echo "<script>document.location.href='?kep_penilaian#rincian" . $_POST['idp'] . "';</script>";
    $_SESSION['ket_nilai'] = "UBAH";
} catch (PDOException $e) {
    echo "<script>alert('DATA UBAH KEP KOMPETENSI-');";
    echo "document.location.href='?error404';</script>";
}
