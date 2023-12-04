<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
$idpr = decryptString($_POST['idpr'], $customkey);
//cek data from modal tambah bila tidak diiisi
if (
    $_POST['bst'] == "" ||
    $_POST['crs'] == "" ||
    $_POST['css'] == "" ||
    $_POST['minicex'] == "" ||
    $_POST['rps'] == "" ||
    $_POST['osler'] == "" ||
    $_POST['dops'] == "" ||
    $_POST['cbd'] == "" ||
    ($_POST['bst'] < 0 || $_POST['bst'] > 100) ||
    ($_POST['crs'] < 0 || $_POST['crs'] > 100) ||
    ($_POST['css'] < 0 || $_POST['css'] > 100) ||
    ($_POST['minicex'] < 0 || $_POST['minicex'] > 100) ||
    ($_POST['rps'] < 0 || $_POST['rps'] > 100) ||
    ($_POST['osler'] < 0 || $_POST['osler'] > 100) ||
    ($_POST['dops'] < 0 || $_POST['dops'] > 100) ||
    ($_POST['cbd'] < 0 || $_POST['cbd'] > 100)
) {
    echo json_encode(['ket' => 'ERROR']);
} else {
    try {
        $sql_update = "UPDATE tb_nilai_ked_coass SET ";
        $sql_update .= " tgl_ubah = '" . date('Y-m-d G:i:s') . "', ";
        $sql_update .= " bst = '" . $_POST['bst'] . "', ";
        $sql_update .= " crs = '" . $_POST['crs'] . "', ";
        $sql_update .= " css = '" . $_POST['css'] . "', ";
        $sql_update .= " minicex = '" . $_POST['minicex'] . "', ";
        $sql_update .= " rps = '" . $_POST['rps'] . "', ";
        $sql_update .= " osler = '" . $_POST['osler'] . "', ";
        $sql_update .= " dops = '" . $_POST['dops'] . "', ";
        $sql_update .= " cbd = '" . $_POST['cbd'] . "'";
        $sql_update .= " WHERE id_praktikan = '" . $idpr . "'";
        echo json_encode([
            // 'sql' => "'.$sql_update.'",
            'ket' => 'SUCCESS'
        ]);
        $conn->query($sql_update);
    } catch (PDOException $e) {
        echo json_encode([
            // 'sql' => "'.$sql_update.'",
            'ket' => 'ERROR'
        ]);
    }
}
