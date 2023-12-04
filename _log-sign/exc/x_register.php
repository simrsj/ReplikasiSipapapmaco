<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
error_reporting(0);
//cari id_user 
$sql_id_user = "SELECT MAX(id_user) AS ID FROM tb_user";
try {
    $q_id_user  = $conn->query($sql_id_user);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA ID USER-');";
    echo "document.location.href='?error404';</script>";
}
$d_id_user = $q_id_user->fetch(PDO::FETCH_ASSOC);
$id_user = bin2hex(urlencode(base64_encode($d_id_user['ID'] + 1)));

$id_institusi = $_POST['institusi'];
$nama_user = $_POST['nama'];
$no_telp_user = $_POST['telp'];
$email_user = $_POST['email'];
$password_user = MD5($_POST['password']);
$crypt = urlencode(base64_encode(date('Ymd') . '_' . $id_user . '_' .  $email_user .  '_' . $nama_user . '"'));

if ($id_institusi == 0) {

    $nama_institusi = $_POST['nama_institusi'];

    // //cari id_mou
    // $no = 1;
    // $sql_id_mou = "SELECT id_mou FROM tb_mou ORDER BY id_mou ASC";
    // $q_id_mou = $conn->query($sql_id_mou);
    // while ($d_id_mou = $q_id_mou->fetch(PDO::FETCH_ASSOC)) {
    //     if ($d_id_mou['id_mou'] != $no) {
    //         $id_mou = $no;
    //         break;
    //     }
    //     $no++;
    //     $id_mou = $no;
    // }

    // //tambah MoU baru
    // $sql_insert_mou = "INSERT INTO `tb_mou` (id_mou, id_institusi) VALUES ('$id_mou', '$id_institusi')";
    // $conn->query($sql_insert_mou);
    // // echo "<br>" . $sql_insert_mou;

    //cari id_institusi
    $sql_id_institusi = "SELECT id_institusi FROM tb_institusi ORDER BY id_institusi DESC LIMIT 1";
    try {
        $q_id_institusi = $conn->query($sql_id_institusi);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA INSERT INSTITUSI-');";
        echo "document.location.href='?error404';</script>";
    }
    $d_id_institusi = $q_id_institusi->fetch(PDO::FETCH_ASSOC);
    $id_institusi = $d_id_institusi['id_institusi'] + 1;

    //tambah institusi baru
    $sql_insert_institusi = "INSERT INTO `tb_institusi` (id_institusi, nama_institusi) VALUES ('$id_institusi', '$nama_institusi')";
    // echo "<br>" . $sql_insert_institusi;
    try {
        $conn->query($sql_insert_institusi);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA INSERT INSTITUSI-');";
        echo "document.location.href='?error404';</script>";
    }
} else {
    $nama_institusi = NULL;
}

$sql_insert_user = "INSERT INTO tb_user (";
// $sql_insert_user .= " id_mou, ";
$sql_insert_user .= " id_user, ";
$sql_insert_user .= " id_institusi, ";
$sql_insert_user .= " username_user, ";
$sql_insert_user .= " password_user, ";
$sql_insert_user .= " nama_user, ";
$sql_insert_user .= " email_user, ";
$sql_insert_user .= " level_user,";
$sql_insert_user .= " no_telp_user, ";
$sql_insert_user .= " tgl_buat_user, ";
$sql_insert_user .= " kode_aktivasi_user, ";
$sql_insert_user .= " status_user";
$sql_insert_user .= " ) VALUES (";
// $sql_insert_user .= "  '" . $id_mou . "', ";
$sql_insert_user .= " '" . base64_decode(urldecode(hex2bin($id_user))) . "', ";
$sql_insert_user .= " '" . $id_institusi . "', ";
$sql_insert_user .= " '" . $email_user . "', ";
$sql_insert_user .= " '" . $password_user . "', ";
$sql_insert_user .= " '" . $nama_user . "', ";
$sql_insert_user .= " '" . $email_user . "', ";
$sql_insert_user .= " '2', ";
$sql_insert_user .= " '" . $no_telp_user . "',";
$sql_insert_user .= " '" . date('Y-m-d', time()) . "', ";
$sql_insert_user .= " '" . $crypt . "', ";
$sql_insert_user .= " 'Y'";
$sql_insert_user .= " )";
// echo "<br>" . $sql_insert_user;

$sql_insert_user_prvl = "INSERT INTO tb_user_privileges (";
$sql_insert_user_prvl .= "id_user";
$sql_insert_user_prvl .= " ) VALUES (";
$sql_insert_user_prvl .= " '" . base64_decode(urldecode(hex2bin($id_user))) . "'";
$sql_insert_user_prvl .= " )";
// echo "<br>" . $sql_insert_user_prvl;
try {
    $conn->query($sql_insert_user);
    $conn->query($sql_insert_user_prvl);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA INSERT USER-');";
    echo "document.location.href='?error404';</script>";
}

echo json_encode(['idu' => $id_user]);
